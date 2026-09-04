/* --------------------------------------------------------------------------------
  Pa Libraries
--------------------------------------------------------------------------------- */

;(function($, window, document, undefined)
{
  'use strict';

  if ($('body').hasClass('wp-admin') && ($('body').hasClass('widgets-php') || $('body').hasClass('wp-customizer')))
  {
    $(window).load(function()
    {
      $('body')
        .pagroups()
        .pacolumns()
        .paaddmore({
          sortable: true
        })
        .pamediaupload()
        .pafields();

        pa.loaded = true;
    });
  }
  else
  {
    $(document).ready(function()
    {
      $('body')
        .pagroups()
        .pacolumns()
        .paaddmore({
          sortable: true
        })
        .pamediaupload()
        .pafields();

        pa.loaded = true;
    });
  }



  /* --------------------------------------------------------------------------------
    Pa Fields - Sets up Field rules and handles dynamic fields
  -------------------------------------------------------------------------------- */

  var PaFields = function(element, options)
  {
    this.element = $(element);

    var _fields_ids = this.element.find('[name="' + pa.prefix + '[fields]"]'),
      fields_ids = _fields_ids.length > 0 ? _fields_ids : this.element.parents('form:first').find('[name="' + pa.prefix + '[fields]"]');

    this.ids = fields_ids.map(function()
               {
                 return $(this).val();
               })
               .get();

    this._init();

    if (typeof pa.validate != 'undefined' && pa.validate)
    {
      this.validation();
    }
  };

  PaFields.prototype = {

    constructor: PaFields,

    processed_conditions: [],

    events: [],

    templates: [],

    _init: function()
    {
      var fields;

      for (var i in this.ids)
      {
        fields = $(':input[name="' + pa.prefix + '[fields]"][value="' + this.ids[i] + '"]').data('pa-fields');
        if (typeof fields != 'undefined')
        {
          this.process_fields(this.ids[i], fields);
        }
      }

      this.process_events();
    },

    process_fields: function(id, fields)
    {
      for (var i in fields)
      {
        for (var j in fields[i])
        {
          this.process_field(fields[i][j], id);
        }
      }
    },

    process_events: function()
    {
      for (var selector in this.processed_conditions)
      {
        $(selector + ':not([type="hidden"])', this.element).off('change', this.conditions_handler);

        $(selector + ':not([type="hidden"])', this.element).on('change', {
          pafields: this,
          list: this.processed_conditions[selector]
        }, this.conditions_handler);

        $(selector, this.element).trigger('change');
      }
    },

    process_field: function(field, fields_id)
    {
      if (field.id && field.id.indexOf('__i__') > -1)
      {
        var widget = $('input[value="' + fields_id + '"]:last').parents('.widget').attr('id'),
          n = widget.charAt(widget.length - 1);

        if (!isNaN(parseFloat(n)) && isFinite(n))
        {
          field.id = field.id.toString().replace('__i__', n);
          field.name = field.name.toString().replace('__i__', n);
        }
        else
        {
          return false;
        }
      }

      if (field.multiple && field.name)
      {
        if (field.name.match(/\[[\d]+\]/g))
        {
          var selector = '',
            selectors = field.name.split(/\[[\d]+\]/),
            fields;

          for (var i = 0; i < selectors.length; i++)
          {
            if (i === 0)
            {
              selector += ':input[name^="' + selectors[i] + '"]';
            }
            else if (i == selectors.length - 1)
            {
              selector += '[name$="' + selectors[i] + '"]';
            }
            else
            {
              selector += '[name*="' + selectors[i] + '"]';
            }
          }

          selector += ':not([type="hidden"])';

          $(selector, this.element)
            .on('change', this.multiple_handler)
            .each(this.multiple_handler);
        }
        else
        {
          $(':input[name="' + field.name + '"]:not([type="hidden"])', this.element)
            .on('change', this.multiple_handler)
            .each(this.multiple_handler);
        }
      }

      if (field.conditions)
      {
        var field_id,
          field_selector,
          field_event;

        for (var i in field.conditions)
        {
          if (i != 'relation' && typeof field.name != 'undefined')
          {
            switch (field.conditions[i].type)
            {
              case 'update':

                field_selector = '[name="' + field.conditions[i].name + '"]';
                field_event = ':input[name="' + field.name + '"]';

              break;

              default:

                field_selector = '[name="' + field.name + '"]';
                field_event = '.' + field.conditions[i].id;

              break;
            }

            if (typeof this.processed_conditions[field_event] === 'undefined')
            {
              this.processed_conditions[field_event] = [];
            }

            this.processed_conditions[field_event].push({
              selector: field_selector,
              conditions: field.conditions
            });
          }
        }

        $('.pa-field-condition-toggle', this.element).each(function()
        {
          var hide = {
            'position': 'absolute',
            'left': '-9999999px',
            'visibility': 'hidden',
            'opacity': 0
          };

          if ($(this).parents('table.form-table').length > 0)
          {
            $(this).parents('tr:eq(0)').css(hide);
          }
        });
      }

      var options = typeof field.options === 'object' ? field.options : null;

      switch (field.type)
      {
        case 'editor':

          if (typeof this.templates['pa-editor-proxy'] == 'undefined' && $('#wp-pa-editor-proxy-wrap').length > 0)
          {
            this.templates['pa-editor-proxy'] = $('#wp-pa-editor-proxy-wrap').html().trim();

            $('#wp-pa-editor-proxy-wrap').remove();
          }

          var $this = this,
            is_widget = $('body').hasClass('widgets-php') || $('body').hasClass('wp-customizer'),
            editor_ids = [];

          $('textarea[name*="' + field.name.split(/(?!^)\[[\d]+\]/g).join('"][name*="') + '"]', this.element).each(function()
          {
            var element = $(this),
              wrapper = element.parents('.wp-editor-wrap:eq(0)'),
              id = element.attr('id'),
              original_id = id.replace(/_\d_/g, '_0_').replace(/\d+$/, 0),
              index = id.match(/\d+$/)[0],
              template;

            if (index == 0 && typeof $this.templates[id] == 'undefined')
            {
              $this.templates[id] = wrapper.prop('outerHTML');
            }

            if (typeof tinyMCEPreInit.qtInit[id] == 'undefined' && field.options.qtInit)
            {
              tinyMCEPreInit.qtInit[id] = JSON.parse(JSON.stringify(field.options.qtInit));
              tinyMCEPreInit.qtInit[id].id = id;
            }

            if (typeof tinyMCEPreInit.mceInit[id] == 'undefined' && field.options.mceInit)
            {
              tinyMCEPreInit.mceInit[id] = JSON.parse(JSON.stringify(field.options.mceInit));
              tinyMCEPreInit.mceInit[id].elements = id;
              tinyMCEPreInit.mceInit[id].selector = '#' + id;
              tinyMCEPreInit.mceInit[id].body_class = tinyMCEPreInit.mceInit[id].body_class.replace(original_id, id);
            }

            if (element.parents('#wp-' + id + '-editor-container').length == 0)
            {
              if (typeof $this.templates[original_id] == 'undefined')
              {
                original_id = element.attr('name').replace(/\[[\d]+\]/g, '[0]').replace(/\]/g, '').replace(/\[/g, '_');
                original_id += (original_id.indexOf('_', original_id.length - 1) !== -1 ? null : '_') + 0;
              }

              template = $($this.templates[original_id].replace(new RegExp(original_id, 'g'), id));

              template
                .find('textarea')
                .attr('name', element.attr('name'))
                .attr('id', element.attr('id'))
                .val(element.val());

              $(template).insertAfter(wrapper);

              wrapper.remove();

              tinyMCE.execCommand(tinymce.majorVersion == 3 ? 'mceRemoveControl' : 'mceRemoveEditor', true, id);

              editor_ids.push(id);
            }
            else if (is_widget)
            {
              tinyMCE.execCommand(tinymce.majorVersion == 3 ? 'mceRemoveControl' : 'mceRemoveEditor', true, id);

              editor_ids.push(id);
            }

            if (element.hasClass('pa-error'))
            {
              wrapper.addClass('pa-error');
            }
          });

          for (var i = 0; i < editor_ids.length; i++)
          {
            if (typeof tinyMCEPreInit.qtInit[editor_ids[i]] != 'undefined')
            {
              quicktags(tinyMCEPreInit.qtInit[editor_ids[i]]);

              QTags._buttonsInit();
            }

            if (typeof tinyMCEPreInit.mceInit[editor_ids[i]] != 'undefined')
            {
              if (typeof switchEditors != 'undefined' && typeof tinyMCEPreInit.qtInit[editor_ids[i]] != 'undefined')
              {
                switchEditors.go(editor_ids[i], 'tmce');
              }
              else
              {
                tinyMCE.init(tinyMCEPreInit.mceInit[editor_ids[i]]);
              }
            }
          }

        break;

        case 'datepicker':

          $(':input[name*="' + field.name.split(/(?!^)\[[\d]+\]/g).join('"][name*="') + '"]:not(.hasDatepicker)', this.element).each(function()
          {
            $(this)
              .attr('autocomplete', 'off')
              .datepicker(options);
          });

        break;

        case 'colorpicker':

          $(':input[name*="' + field.name.split(/(?!^)\[[\d]+\]/g).join('"][name*="') + '"]', this.element).wpColorPicker(options);

        break;

        case 'file':

          $(':input.' + field.attributes.class, this.element)
            .data('multiple', typeof field.options.multiple != 'undefined' ? field.options.multiple : 'true')
            .data('save', typeof field.options.save != 'undefined' ? field.options.save : 'id');

        break;
      }

      // Legacy/Inline field configuration option
      if (field.js_callback)
      {
        window[field.js_callback](field);
      }

      $(document).trigger('pa:field:render', [field]);
    },

    multiple_handler: function(event)
    {
      var add_more = $(this).parents('div[data-pa-field-addmore]:eq(0)'),
        context = add_more.length > 0 ? add_more : null,
        value = $(':input[name="' + $(this).attr('name') + '"]:not([type="hidden"])' + ($(this).is(':checkbox') || $(this).is(':radio') ? ':checked' : ''), context).val(),
        hidden = $(':input[name="' + $(this).attr('name') + '"][type="hidden"]', context);

      if (value)
      {
        hidden.attr('disabled', 'disabled');
      }
      else
      {
        hidden.removeAttr('disabled', 'disabled');
      }
    },

    conditions_handler: function(event)
    {
      var $this = event.data.pafields;

      for (var i in event.data.list)
      {
        $this.conditions($(this), event.data.list[i].selector, event.data.list[i].conditions);
      }
    },

    conditions: function(condition_field, selector, list)
    {
      var field, element, parent, context, i, widget, widget_id, widget_id_base,
        conditions = [],
        condition_value,
        condition_selector,
        add_more = condition_field.parents('div[data-pa-field-addmore]:eq(0)').length > 0 ? condition_field.parents('div[data-pa-field-addmore]:eq(0)') : null,
        relation = 'and',
        form = condition_field.parents('form:first'),
        index = condition_field.index('*[name="' + condition_field.attr('name') + '"]:not(:input[type="hidden"])'),
        reset_selector = selector.replace(/\[[\d]+(?!.*[\d])\]/, '[' + index + ']'),
        update,
        result,
        outcomes = [],
        overall_outcome = true,
        value,
        values = [],
        show = {
          'position': 'relative',
          'left': 'auto',
          'visibility': 'visible'
        },
        hide = {
          'position': 'absolute',
          'left': '-9999999px',
          'visibility': 'hidden',
          'opacity': 0
        };

      // Get the field in question
      field = $('*[name*="' + (selector == reset_selector ? selector : reset_selector).replace('[name="', '').replace('"]', '').split(/(?!^)\[[\d]+\]/g).join('"][name*="') + '"]', add_more);

      // Determine the conditions and relation
      for (i in list)
      {
        if (i == 'relation')
        {
          relation = list[i];
        }
        else
        {
          conditions.push(list[i]);
        }
      }

      context = add_more ? add_more : form;
      widget = $(':input[type="hidden"][name="widget_number"]', form);

      // Check the conditions and their outcomes
      for (i in conditions)
      {
        if (typeof conditions[i].name != 'undefined')
        {
          result = false;
          values = $.isArray(conditions[i].value) ? conditions[i].value : [conditions[i].value];

          if (conditions[i].type == 'update')
          {
            element = condition_field;
          }
          else
          {
            if (widget.length > 0)
            {
              widget_id = $(':input[type="hidden"][name="multi_number"]', form).val();
              widget_id = !widget_id ? widget.val() : widget_id;
              widget_id_base = $(':input[type="hidden"][name="id_base"]', form).val();

              element = '[name^="widget-' + widget_id_base + '[' + widget_id + ']' + '[' + conditions[i].field + ']"]';
            }
            else
            {
              element = '';

			  	$(conditions[i].field.split(':')).each(function(index, part)
	            {
	              element += '[name*="[' + part + ']"]';
	            });

            }

            element = $(':input' + element, context);
          }

          if (element.is('select'))
          {
            value = element.children('option:selected').val();
          }
          else if (element.is(':radio, :checkbox'))
          {
            var _values = [];

            element.each(function()
            {
              if ($(this).is(':checked'))
              {
                _values.push($(this).val());
              }
            });

            value = _values.length > 0 ? _values : value;
          }
          else
          {
            value = element.val();
          }

          if ($.isArray(value))
          {
            value = $.map(value, function(v, i)
            {
              return isNaN(v) ? v : parseFloat(v);
            });

            result = $.intersect(value, values).length > 0;
          }
          else
          {
            result = $.inArray(value, values) != -1;
          }

          if (typeof conditions[i].compare != 'undefined' || conditions[i].compare == '!=')
          {
            result = !result;
          }

          outcomes.push({
            condition: conditions[i],
            result: result
          });
        }
      }

      // Dertermine overall condition based on outcomes
      for (i = 0; i < outcomes.length; i++)
      {
        if (outcomes[i].condition.type != 'update')
        {
          if (relation == 'and')
          {
            overall_outcome = overall_outcome && outcomes[i].result;
          }
          else if (relation == 'or')
          {
            overall_outcome = !overall_outcome && !outcomes[i].result ? outcomes[i].result : overall_outcome || outcomes[i].result;
          }
        }
      }

      if (relation == 'or' && overall_outcome && outcomes.length > 0)
      {
        overall_outcome = false;

        for (i = 0; i < outcomes.length; i++)
        {
          if (outcomes[i].result)
          {
            overall_outcome = true;

            break;
          }
        }
      }

      context = null;

      // Find context
      if (field.parents('table.form-table:eq(0)').length > 0)
      {
        var row = field.parents('tr:eq(0)'),
          total = row.find('.pa-field-element').length,
          hidden = row.find('.pa-field-element-condition').length;

        if (total - hidden < 1)
        {
          context = row;
        }
      }

      if (!context)
      {
        if (field.parents('.pa-field-condition-toggle').length > 0)
        {
          context = field.parents('.pa-field-condition-toggle');
        }
        else if (field.parents('div[data-pa-field-group="' + field.data('pa-field-group') + '"]').length)
        {
          context = field.parents('div[data-pa-field-group="' + field.data('pa-field-group') + '"]');
        }
      }

      // Check if we are in an add more
      if (context && context.parent('.pa-field-addmore-wrapper').length > 0 && field.parents('.pa-field-addmore-wrapper').length > condition_field.parents('.pa-field-addmore-wrapper').length)
      {
        context = context.parent('.pa-field-addmore-wrapper');
      }

      for (i in outcomes)
      {
        switch (outcomes[i].condition.type)
        {
          case 'update':

            condition_selector = '[name="' + outcomes[i].condition.name + '"]';

          break;

          default:

            condition_selector = '[name="' + field.attr('name') + '"]';

          break;
        }

        $(condition_selector, context).each(function()
        {
          field = $(this);

          switch (outcomes[i].condition.type)
          {
            case 'update':

              if (!pa.loaded)
              {
                break;
              }

              update = false;

              if (condition_field.is(':radio') || condition_field.is(':checkbox'))
              {
                condition_value = condition_field.is(':checked') ? condition_field.val() : '';
              }
              else
              {
                condition_value = condition_field.val();
              }

              if ($.isArray(outcomes[i].condition.value) && $.inArray(condition_value, outcomes[i].condition.value) > -1)
              {
                update = true;
              }
              else
              {
                if (condition_value == outcomes[i].condition.value)
                {
                  if (condition_field.is(':radio') || condition_field.is(':checkbox'))
                  {
                    update = condition_field.is(':checked');
                  }
                  else
                  {
                    update = true;
                  }
                }
              }

              if (update)
              {
                if (field.is('select'))
                {
                  if (typeof outcomes[i].condition.choices != 'undefined')
                  {
                    field.empty();

                    for (var key in outcomes[i].condition.choices)
                    {
                      field
                        .append($('<option></option>')
                        .attr('value', key).text(outcomes[i].condition.choices[key]));
                    }
                  }

                  if (field.children('option[value="' + outcomes[i].condition.update + '"]').length > 0)
                  {
                    field.children('option').removeAttr('selected');
                    field.children('option[value="' + outcomes[i].condition.update + '"]').attr('selected', 'selected');
                  }
                }
                else
                {
                  field.val(outcomes[i].condition.update);
                }

                field.trigger('change');
              }

            break;

            case 'readonly':
            case 'disabled':

              if (overall_outcome)
              {
                field.attr(outcomes[i].condition.type, outcomes[i].condition.type);
              }
              else
              {
                field.removeAttr(outcomes[i].condition.type);
              }

              field.trigger('change');

            break;

            default:

              if (context != null)
              {
                if (context.css('visibility') == 'hidden' && overall_outcome)
                {
                  context
                    .css(show)
                    .animate({
                      'opacity': 1
                    });

                  context.find('.pa-field-condition-hidden').removeClass('pa-field-condition-hidden');
                }
                else if (!overall_outcome)
                {
                  if (outcomes[i].condition.reset)
                  {
                    if (field.is(':radio') || field.is(':checkbox'))
                    {
                      field = $(selector == reset_selector ? selector : reset_selector);

                      if (field.is(':checked'))
                      {
                        field
                          .attr('checked', false)
                          .trigger('change');
                      }
                    }
                    else
                    {
                      if (field.is('select'))
                      {
                        if (field.children('option[selected="selected"]').length > 0)
                        {
                          field
                            .children('option')
                            .removeAttr('selected');

                          field.trigger('change');
                        }
                      }
                      else
                      {
                        if (field.val() != '')
                        {
                          field
                            .val('')
                            .trigger('change');
                        }
                      }
                    }
                  }

                  context.css(hide);

                  field.addClass('pa-field-condition-hidden');
                }
              }

            break;
          }
        });
      }

      return false;
    },

    validation: function()
    {
      this.id_forms = this.element.find('[name="' + pa.prefix + '[fields]"]').map(function()
      {
        return $(this).parents('form:first');
      })
      .get();

      for (var i = 0; i < this.id_forms.length; i++)
      {
        this.id_forms[i]
          .off('submit', this, this.validation_handler)
          .on('submit', this, this.validation_handler);
      }
    },

    validation_handler: function(event)
    {
      var fields_id = $('[name="' + pa.prefix + '[fields]"]', this),
        $this = event.data;

      if (fields_id.length == 0)
      {
        return false;
      }

      if (typeof tinyMCE != 'undefined')
      {
        tinyMCE.triggerSave();
      }

      var form = $(this),
        submit = form.find(':input[type=submit]:focus'),
        data = $.param(form.serializeArray()),
        target = event.originalEvent || event.originalTarget;

      if (submit.length == 0 && typeof target != 'undefined')
      {
        submit = $(target.srcElement || target.originalTarget);
      }

      if (submit)
      {
        $.ajax({
          type: 'POST',
          url: ajaxurl,
          dataType: 'json',
          data: {
            action: 'pa_validate',
            method: 'check',
            data: data
          },
          beforeSend: function()
          {
            if ($('.spinner').length > 0)
            {
              $('.spinner').hide();
            }

            submit.attr('disabled', 'disabled');
          },
          complete: function(response)
          {
            submit
              .removeAttr('disabled')
              .removeClass('disabled');
          },
          success: function(response)
          {
            submit
              .removeAttr('disabled')
              .removeClass('disabled');

            if (!response.success)
            {
              $('#pa_validation_error').remove();
              $('.pa-error').removeClass('pa-error');

              for (var i = 0; i < response.data.errors.length; i++)
              {
                var field_name = response.data.errors[i],
                  input = $(':input[name="' + field_name + '"]');

                if (input.length == 0 && field_name.substr(-2) == '[]')
                {
                  // Handle fields that have rules applied to the group level
                  field_name = field_name.slice(0, -2);

                  $(':input[name^="' + field_name + '"]').each(function()
                  {
                    var input = $(this);

                    if (input.attr('type') == 'hidden' && input.parent('.pa-field-preview').length > 0)
                    {
                      input.parent('.pa-field-preview').prev().addClass('pa-error');
                    }
                    else if (input.hasClass('wp-editor-area'))
                    {
                      input.parents('.wp-editor-wrap:eq(0)').addClass('pa-error');
                    }

                    input.addClass('pa-error');
                  });
                }
                else
                {
                  if (input.attr('type') == 'hidden' && input.parent('.pa-field-preview').length > 0)
                  {
                    input.parent('.pa-field-preview').prev().addClass('pa-error');
                  }
                  else if (input.hasClass('wp-editor-area'))
                  {
                    input.parents('.wp-editor-wrap:eq(0)').addClass('pa-error');
                  }

                  for (var idx = 0; idx < response.data.error_indexes_per_field[field_name].length; idx++)
                  {
                    $(input[response.data.error_indexes_per_field[field_name][idx]]).addClass('pa-error');
                  }
                }
              }

              $(response.data.notice).insertBefore(form);
            }
            else
            {
              form.off('submit');

              submit.trigger('click');
            }
          }
        });
      }

      return false;
    }
  };

  $.fn.pafields = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();

    return this.each(function()
    {
      var $this = $(this),
        data = $this.data('pafields'),
        options = typeof option === 'object' && option;

      if (!data)
      {
        $this.data('pafields', (data = new PaFields(this, $.extend({}, $.fn.pafields.defaults, options, $(this).data()))));
      }

      if (typeof option === 'string')
      {
        data[option].apply(data, _arguments);
      }
    });
  };

  $.fn.pafields.defaults = {};

  $.fn.pafields.Constructor = PaFields;



  /* --------------------------------------------------------------------------------
    Pa Groups - Creates Group containers for Grouped Fields
  -------------------------------------------------------------------------------- */

  var PaGroups = function(element, options)
  {
    this.element = $(element);

    this._init();
  };

  PaGroups.prototype = {

    constructor: PaGroups,

    _init: function()
    {
      this.element
        .find('[data-pa-field-group]:not(:radio, :checkbox, :file, div)')
        .each(function()
        {
          var $element = $(this),
            selector = ':input[name="' + $element.attr('name') + '"]',
            group = $element.data('pa-field-group'),
            sub_group = $element.data('pa-field-sub-group');

          if ($element.is('textarea') && $element.hasClass('wp-editor-area'))
          {
            $element = $(this).parents('.wp-editor-wrap:first');
          }

          if ($element.parents('.pa-field-part').length > 0)
          {
            $element = $element.parents('.pa-field-part:eq(0)');
          }

          if ($element.prev().hasClass('pa-label-position-before'))
          {
            $element = $element
                         .prevUntil('.pa-label-position-before', '.pa-field-part:not(div)')
                         .addBack()
                         .next(':input[type="hidden"].pa-field-part')
                         .addBack()
                         .prev('.pa-label-position-before');
          }
          else if ($element.next().hasClass('pa-label-position-after'))
          {
            $element = $element
                         .nextUntil('.pa-label-position-after', '.pa-field-part:not(div)')
                         .addBack()
                         .prev(':input[type="hidden"].pa-field-part')
                         .addBack()
                         .next('.pa-label-position-after');
          }

          if (!$element.hasClass('wp-editor-wrap') && $element.find(selector).length == 0)
          {
            $element = $element.addBack();
          }

          $element.wrapAll('<div data-pa-field-group="' + group + '" ' + (sub_group ? 'data-pa-field-sub-group="' + sub_group + '"' : '') + ' />');
        });

     this.element
       .find('[data-pa-field-group]')
       .filter(':radio, :checkbox')
       .each(function()
       {
         var $element = $(this),
           group = $element.data('pa-field-group'),
           sub_group = $element.data('pa-field-sub-group'),
           list = $element.parents('.pa-field-list').length > 0,
           parent_selector = list ? '.pa-field-list' : '.pa-field-list-item',
           parent = $element.parents('div[data-pa-field-group]:eq(0)'),
           wrap = $('<div data-pa-field-group="' + group + '" ' + (sub_group ? 'data-pa-field-sub-group="' + sub_group + '"' : '') + ' />');

         if ($element.parents('.pa-field-part').length > 0)
         {
           parent_selector = '.pa-field-part';
         }

         var index = $($element.parents(parent_selector)).index();

         if (parent.length > 0)
         {
           parent.attr('data-pa-field-group', group);

           if (sub_group)
           {
             parent.attr('data-pa-field-sub-group', sub_group);
           }
         }
         else
         {
           if (list)
           {
             $element = $element
               .parents(parent_selector)
               .prev('.pa-field-part:eq(0):not(.pa-label-position-before)')
               .addBack()
               .prev('.pa-field-part:eq(0):not(.pa-label-position-after)');
           }
           else
           {
             $element = $element.parents(parent_selector);

             if ($element.prev().hasClass('pa-label-position-before') || $element.next().length == 0)
             {
               $element = $element
                 .prev('.pa-label-position-before')
                 .addBack()
                 .nextUntil('.pa-field-part', parent_selector);
             }
             else if ($element.next().hasClass('pa-label-position-after') || $element.prev().length == 0)
             {
               $element = $element
                 .next('.pa-label-position-after')
                 .addBack()
                 .prevUntil('.pa-field-part', parent_selector);
             }
             else
             {
               $element = $element
                 .nextUntil(':not(.pa-field-list-item)', parent_selector)
                 .addBack();
             }
           }

           $element
             .addBack()
             .wrapAll(wrap);
         }
       });

       $('.pa-group-label').each(function()
       {
         var label = $(this),
           sibling_group = label.hasClass('pa-label-position-before') ? label.prev('div[data-pa-field-group]:eq(0)') : label.next('div[data-pa-field-group]:eq(0)');

         if (sibling_group.length > 0)
         {
           var group = sibling_group.data('pa-field-group'),
             sub_group = sibling_group.data('pa-field-sub-group'),
             wrap = $('<div data-pa-field-group="' + group + '" ' + (sub_group ? 'data-pa-field-sub-group="' + sub_group + '"' : '') + ' />');

           label.wrapAll(wrap);
         }
       });
    }
  };

  $.fn.pagroups = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();

    return this.each(function()
    {
      var $this = $(this),
        data = $this.data('pagroups'),
        options = typeof option === 'object' && option;

      if (!data)
      {
        $this.data('pagroups', (data = new PaGroups(this, $.extend({}, $.fn.pagroups.defaults, options, $(this).data()))));
      }

      if (typeof option === 'string')
      {
        data[option].apply(data, _arguments);
      }
    });
  };

  $.fn.pagroups.defaults = {};

  $.fn.pagroups.Constructor = PaGroups;



  /* --------------------------------------------------------------------------------
    Pa Add More - Creates Add More fields for Pa
  -------------------------------------------------------------------------------- */

  var PaAddMore = function(element, options)
  {
    this.element = $(element);

    this.add = options.add;
    this.remove = options.remove;
    this.move = options.move;
    this.sortable = options.sortable;

    this._init();
  };

  PaAddMore.prototype = {

    constructor: PaAddMore,

    templates: [],

    _init: function()
    {
      var $this = this;

      // NOTE: This fixes most layouts that will break jQuery UI Sortables.
      $('html, body').css('overflow-x', 'initial');

      $(document).on('click', '[data-pa-field-addmore-action]', { paaddmore: $this }, $this.action_handler);

      this.element
        .find('*[data-pa-field-addmore]')
        .each(function()
        {
          var $element = $(this),
            group = $element.data('pa-field-group'),
            set = $element.attr('name'),
            addmore = $element.data('pa-field-addmore'),
            addmore_single = $element.data('pa-field-addmore-single'),
            addmore_actions = $element.data('pa-field-addmore-actions'),
            $wrapper = $('<div />')
                         .attr('data-pa-field-addmore', set)
                         .addClass('pa-field-addmore-wrapper'),
            $wrapper_actions = $('<div />')
                                 .addClass('pa-field-addmore-wrapper-actions')
                                 .css('display', 'inline');

          $this.sortable = $element.data('pa-field-sortable');

          if ($element.parents('div[data-pa-field-addmore="' + $element.attr('name') + '"]').length == 0)
          {
            if ($element.is('[data-pa-field-columns]'))
            {
              $wrapper.css({
                'float': 'none'
              });
            }

            if (group)
            {
              $wrapper.addClass('pa-field-addmore-wrapper-full');
            }

            if ($element.is('textarea') && $element.hasClass('wp-editor-area'))
            {
              $element = $element.parents('.wp-editor-wrap:first');

              if (addmore_single)
              {
                $element.data('pa-field-addmore-single', true);
              }
            }

            if ($element.is(':checkbox, :radio, :input[type="hidden"]') && !$element.data('pa-field-group'))
            {
              var $parent = $(':input[name="' + $element.attr('name') + '"]').commonAncestor();

              if ($parent.parents('div[data-pa-field-group="' + group + '"], div[data-pa-field-sub-group="' + group + '"]').length > 0)
              {
                $parent = $parent.parents('div[data-pa-field-group="' + group + '"], div[data-pa-field-sub-group="' + group + '"]');
              }

              if ($parent.parents('.pa-field-part').length > 0)
              {
                $parent = $parent.parents('.pa-field-part:eq(0)');
              }

              if ($element.is(':input[type="hidden"]'))
              {
                $wrapper.addClass('pa-field-addmore-wrapper-full');
              }

              if ($parent.parent('div[data-pa-field-addmore="' + $element.attr('name') + '"]').length == 0)
              {
                $element = $parent
                  .siblings('div[data-pa-field-group="' + group + '"], div[data-pa-field-sub-group="' + group + '"], .pa-field-part:first')
                  .addBack()
                  .wrapAll($wrapper);
              }
            }
            else
            {
              if (typeof group === 'undefined')
              {
                if ($element.parent('.pa-field-column').length > 0)
                {
                  $element = $element
                    .parent('.pa-field-column')
                    .wrapAll($wrapper);
                }
                else
                {
                  $element = $element
                    .siblings('.pa-field-part')
                    .addBack()
                    .wrapAll($wrapper);
                }
              }
              else
              {
                if (addmore_single)
                {
                  $element
                    .parents('div[data-pa-field-group="' + group + '"], div[data-pa-field-sub-group="' + group + '"]')
                    .wrapAll($wrapper);
                }
                else
                {
                  set = $('div[data-pa-field-group="' + group + '"]');

                  set = $this.get_groups(set, group);

                  set.wrapAll($wrapper);
                }
              }
            }

            var $container = $element.parents('div[data-pa-field-addmore' + (typeof set == 'string' ? '="' + set + '"' : '') + ']:first'),
              $parent = $container.parent();

            if (addmore_actions)
            {
              if (($('body').hasClass('widgets-php') || $('body').hasClass('wp-customizer') ? $container.actual('height') : $container.height()) >= 60)
              {
                $wrapper_actions.addClass('pa-field-addmore-wrapper-actions-vertical');
                $container.addClass('pa-field-addmore-wrapper-vertical');
              }

              $wrapper_actions.prepend($($this.add).attr('data-pa-field-addmore-action', 'add'));
              $wrapper_actions.prepend($($this.remove).attr('data-pa-field-addmore-action', 'remove'));
            }
            else
            {
              $container.addClass('pa-field-sortable');
            }

            if ($this.sortable)
            {
              $container.addClass('pa-field-sortable-active');
            }

            $parent
              .sortable({
                items: '> div[data-pa-field-addmore]:not([name])',
                cursor: 'move',
                placeholder: 'pa-addmore-placeholder',
                disabled: $this.sortable ? false : true,
                cancel: '.wp-editor-tabs, .wp-editor-container, :input, a',
                start: function(event, ui)
                {
                  ui.placeholder.height(ui.item.innerHeight());
                  ui.placeholder.width(ui.item.outerWidth());
                },
                update: function(event, ui)
                {
                  $this.re_index($(this), true);
                }
              });

            if ($element.siblings('.pa-field-addmore-wrapper-actions').length == 0)
            {
              $element
                .parents('div.pa-field-addmore-wrapper:eq(0)')
                .append($wrapper_actions);
            }
          }
        });

      this.element
        .find('*[data-pa-field-addmore]')
        .each(function()
        {
          var $element = $(this),
            $html = $element.parents('div[data-pa-field-addmore]:first'),
            name = $html.data('pa-field-addmore'),
            names = [],
            excludes = '[data-pa-field-addmore], [data-pa-field-group], .pa-field-addmore-wrapper-actions, .pa-field-addmore-wrapper, .pa-field-column';

          if (typeof name != 'undefined')
          {
            var template_name = name.replace(/(?!^)\[[\d]+\]/g, '[0]');

            if (typeof $this.templates[template_name] == 'undefined')
            {
              $html = $('<div/>').append($html.parent().html());

              $html.find('div[data-pa-field-addmore]').each(function()
              {
                var data = $(this).data('pa-field-addmore').replace(/(?!^)\[[\d]+\]/g, '[0]');

                if ($.inArray(data, names) == -1)
                {
                  $(this).find(':input:not([data-pa-field-addmore-clear="0"])').each(function()
                  {
                    $(this)
                      .removeClass('pa-error')
                      .attr('data-pa-original-id', $(this).attr('id'))
                      .removeAttr('id')
                      .off()
                      .find('option')
                      .removeAttr('selected');

                    if ($(this).is(':checkbox'))
                    {
                      $(this).removeAttr('checked');
                    }

                    if (!$(this).is(':checkbox, :radio'))
                    {
                      $(this).removeAttr('value');
                    }

                    if ($(this).is('textarea'))
                    {
                      $(this).empty();
                    }
                  });

                  if (!$(this).prev().is(excludes))
                  {
                    $(this).prev().remove();
                  }

                  if (!$(this).next().is(excludes))
                  {
                    $(this).next().remove();
                  }

                  $(this)
                    .find('.pa-field-preview *:not(ul.attachments, div.pa-field-addmore-wrapper-actions, div.pa-field-addmore-wrapper-actions *, :input[type="hidden"])')
                    .remove();

                  names.push(data);
                }
                else
                {
                  $(this).remove();
                }
              });

              $html.children().each(function()
              {
                if (!$(this).is('.pa-field-addmore-wrapper-actions, [data-pa-field-addmore="' + name + '"]'))
                {
                  $(this).remove();
                }
              });

              $this.templates[template_name] = $html.html().trim();
            }
          }
        });

      $('.wp-editor-area, .wp-editor-area-proxy').parents('.pa-field-addmore-wrapper').addClass('pa-field-addmore-wrapper-full');
    },

    get_groups: function(set, group)
    {
      var $this = this,
        groups_collected = false,
        _group = group;

      do {
        $('div[data-pa-field-sub-group="' + _group + '"]').each(function()
        {
          _group = $(this).data('pa-field-group');

          set.push(this);

          set = $this.get_groups(set, _group);
        });

        groups_collected = $('div[data-pa-field-sub-group="' + _group + '"]').length == 0;

      } while(!groups_collected);

      return set;
    },

    action_handler: function(event)
    {
      event.preventDefault();

      if (event.isPropagationStopped())
      {
        return;
      }

      event.stopPropagation();

      var $element = $(this),
        $wrapper = $element.parents('div.pa-field-addmore-wrapper:first'),
        count = $wrapper.siblings('div.pa-field-addmore-wrapper').length,
        element = $wrapper.data('pa-field-addmore'),
        element_indexes = element ? element.replace(/\]/g, '').split('[') : [],
        groups = 0,
        $this = event.data.paaddmore;

      for (var j = element_indexes.length - 1; j >= 0; j--)
      {
        if ($.isNumeric(element_indexes[j]))
        {
          groups = groups + 1;
        }
      }

      $wrapper.parent('.ui-sortable').css('height', 'auto');

      switch ($element.data('pa-field-addmore-action'))
      {
        case 'add':

          var name = $wrapper.attr('data-pa-field-addmore').replace(/(?!^)\[[\d]+\]/g, '[0]'),
            template = $this.templates[name],
            sub_group = $(template).find('div[data-pa-field-addmore="' + name + '"]:first');

          if (sub_group.length > 0)
          {
            template = $(sub_group).clone().wrap('<div>').parent().html();
          }

          $wrapper.parent().find(':radio').each(function()
          {
            if ($(this).is(':checked'))
            {
              $(this).data('pa-field-checked', 'true');
            }
          });

          $(template).insertAfter($wrapper);

          $wrapper
            .parent()
            .children('div.pa-field-addmore-wrapper')
            .each(function(i)
            {
              $(this)
                .sortable({
                  items: '> div[data-pa-field-addmore]:not([name])',
                  cursor: 'move',
                  placeholder: 'pa-addmore-placeholder',
                  cancel: '.wp-editor-tabs, .wp-editor-container, :input, a',
                  start: function(event, ui)
                  {
                    ui.placeholder.height(ui.item.innerHeight());
                    ui.placeholder.width(ui.item.outerWidth());
                  },
                  update: function(event, ui)
                  {
                    $this.re_index($(this), true);
                  }
                });
            });

          $this.re_index($wrapper.parent(), false);

          $wrapper = $wrapper.next();

          $wrapper.trigger('paaddmore', [$wrapper, 'add']);

          if ($wrapper.find('.wp-editor-wrap').length > 0)
          {
            $wrapper.addClass('pa-field-addmore-wrapper-full');
          }

        break;

        case 'remove':

          if (count > 0)
          {
            var $sortable = $wrapper.parent(),
              $containers = $sortable.children('div.pa-field-addmore-wrapper');

            $wrapper
              .trigger('paaddmore', [$wrapper, 'remove'])
              .remove();

            $this.re_index($sortable, true);
          }

        break;
      }
    },

    re_index: function(wrapper, sort)
    {
      if (wrapper.length == 0)
      {
        return;
      }

      wrapper.find('> div[data-pa-field-addmore]').each(function()
      {
        var element = $(this);

        if (sort)
        {
          element.find(':radio').each(function()
          {
            if ($(this).is(':checked'))
            {
              $(this).data('pa-field-checked', 'true');
            }
          });
        }

        element.find(':input').each(function()
        {
          var id,
            name = $(this).attr('name'),
            is_widget = $('body').hasClass('widgets-php') || $('body').hasClass('wp-customizer');

          if (name)
          {
            var level = 0,
              index,
              _indexes = [],
              indexes = name.replace(/\]/g, '').split('['),
              levels = $(this).parents('div[data-pa-field-addmore]').length - 1,
              scope = indexes[0],
              parent = $(this).parents('div[data-pa-field-addmore]:eq(0)'),
              value = $(this).val();

            for (var i = 0; i <= levels; i++)
            {
              _indexes.push($(parent.parents('.ui-sortable:eq(' + i + ')').children('div[data-pa-field-addmore]')).index(i == 0 ? parent : parent.parents('.ui-sortable:eq(' + (i - 1) + ')')));
            }

            for (var j = 0; j < indexes.length; j++)
            {
              if ($.isNumeric(indexes[j]))
              {
                if (!is_widget || (is_widget && level > 0))
                {
                  if ($.isNumeric(_indexes[_indexes.length - (is_widget ? level : level + 1)]))
                  {
                    indexes[j] = _indexes[_indexes.length - (is_widget ? level : level + 1)];
                  }
                }

                level = level + 1;
              }

              indexes[j] = indexes[j] + (scope !== indexes[j] ? ']' : '');
            }

            index = _indexes.slice(-1).pop();

            name = indexes.join('[');

            id = (is_widget ? indexes.splice(0, 2).join('-').replace(/]/g, '') + '-' + indexes.join('_').replace(/]/g, '') : indexes.join('_').replace(/]/g, ''));
            id += (id.indexOf('_', id.length - 1) !== -1 ? null : '_') + index;

            $(this)
              .attr('name', name)
              .attr('id', id);

            if (!$(this).is(':file'))
            {
              $(this).val(value);
            }

            parent.find('[for="' + name + '"]').attr('for', name);
          }
        });

        var radios = [];

        element.find(':radio').each(function()
        {
          $(this).removeAttr('checked');

          if ($.inArray($(this).attr('name'), radios) == -1)
          {
            radios.push($(this).attr('name'));
          }

          if (typeof $(this).data('pa-field-checked') != 'undefined')
          {
            $(this)
              .attr('checked', 'checked')
              .removeData('pa-field-checked');
          }
        });

        for (var i in radios)
        {
          if ($(':radio[name="' + radios[i] + '"]:checked').length == 0)
          {
            $(':radio[name="' + radios[i] + '"]:eq(0)').attr('checked', 'checked');
          }
        }
      });

      wrapper
        .removeData('pamediaupload')
        .removeData('pafields')
        .pamediaupload()
        .pafields();
    }
  };

  $.fn.paaddmore = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();

    return this.each(function()
    {
      var $this = $(this),
        data = $this.data('paaddmore'),
        options = typeof option === 'object' && option;

      if (!data)
      {
        $this.data('paaddmore', (data = new PaAddMore(this, $.extend({}, $.fn.paaddmore.defaults, options, $(this).data()))));
      }

      if (typeof option === 'string')
      {
        data[option].apply(data, _arguments);
      }
    });
  };

  $.fn.paaddmore.defaults = {
    add: '<a href="#" class="' + ($('body').hasClass('wp-admin') ? 'button-secondary' : '') + ' pa-addmore-button pa-addmore-add"><span>&#43;</span></a>',
    remove: '<a href="#" class="' + ($('body').hasClass('wp-admin') ? 'button-secondary' : '') + ' pa-addmore-button pa-addmore-remove"><span>&ndash;</span></a>',
    sortable: true
  };

  $.fn.paaddmore.Constructor = PaAddMore;



  /* --------------------------------------------------------------------------------
    Pa Columns - Creates fluid column based layout
  -------------------------------------------------------------------------------- */

  var PaColumns = function(element, options)
  {
    this.element = $(element);
    this.total_columns = options.total_columns;
    this.column_width = options.column_width;
    this.gutter_width = options.gutter_width;
    this.gutter_height = options.gutter_height;
    this.minimum_height = options.minimum_height;

    this._init();
  };

  PaColumns.prototype = {

    constructor: PaColumns,

    _init: function()
    {
      var total_columns = this.total_columns,
        column_width = this.column_width,
        gutter_width = this.gutter_width,
        gutter_height = this.gutter_height,
        minimum_height = this.minimum_height,
        track = {
          columns: 0,
          gutters: 0,
          group: false
        };

      this.element
        .find('[data-pa-field-columns]:not(:radio, :checkbox, :input[type="hidden"])')
        .each(function()
        {
          var $element = $(this),
            columns = $element.data('pa-field-columns');

          if ($element.is('textarea') && $element.hasClass('wp-editor-area'))
          {
            $element = $(this).parents('.wp-editor-wrap:first');
          }

          var $parent = $element.parent('div[data-pa-field-group]:eq(0)');

          if ($parent.length > 0)
          {
            $parent.attr('data-pa-field-columns', columns);
          }
          else if (!$element.is('div[data-pa-field-columns]'))
          {
            $element
              .siblings('.pa-field-part:eq(0)')
              .addBack()
              .wrapAll('<div data-pa-field-columns="' + columns + '" />');
          }

          var wrap = $element;

          if (!$element.is('div[data-pa-field-columns]'))
          {
            wrap = wrap
                     .css({
                       'width': $element.attr('size') || $element.is(':button, :submit') ? 'auto' : '100%',
                     })
                     .parent('div[data-pa-field-columns]');
          }

          wrap
            .css({
              'display': 'block',
              'float': 'left',
              'width': (columns * column_width + (columns - 1) * gutter_width) + '%',
              'margin-right': gutter_width + ($.isNumeric(gutter_width) ? '%' : null),
              'margin-bottom': gutter_height + ($.isNumeric(gutter_height) ? '%' : null)
            });
        });

      this.element
        .find('[data-pa-field-columns]')
        .filter(':radio, :checkbox, :input[type="hidden"]')
        .each(function()
        {
          var $element = $(this),
            columns = $element.data('pa-field-columns'),
            group = $element.data('pa-field-group'),
            sub_group = $element.data('pa-field-sub-group'),
            parent_selector;

          if ($element.is(':radio, :checkbox'))
          {
            parent_selector = $element.parents('.pa-field-list').length > 0 ? '.pa-field-list' : '.pa-field-list-item';
          }
          else
          {
            parent_selector = '.pa-field-part';
          }

          $element
            .parents(parent_selector)
            .each(function()
            {
              if ($(this).parent('div[data-pa-field-columns]').length == 0)
              {
                var $parent = $(this).parent('div[data-pa-field-group]:eq(0)');

                if ($parent.length > 0)
                {
                  $parent.attr('data-pa-field-columns', columns);
                }
                else
                {
                  $(this)
                    .siblings('.pa-field-part')
                    .addBack()
                    .wrapAll('<div data-pa-field-columns="' + columns + '" data-pa-field-group="' + group + '" ' + (sub_group ? 'data-pa-field-sub-group="' + sub_group + '"' : '') + ' />');
                }

                $(this)
                  .parent('div[data-pa-field-columns]')
                  .css({
                    'display': 'block',
                    'float': 'left',
                    'width': (columns * column_width + (columns - 1) * gutter_width) + '%',
                    'margin-right': gutter_width + ($.isNumeric(gutter_width) ? '%' : null),
                    'margin-bottom': gutter_height + ($.isNumeric(gutter_height) ? '%' : null)
                  });
              }
            });
        });

      this.element
        .find('div[data-pa-field-columns]')
        .each(function(i)
        {
          var $element = $(this),
            columns = $element.data('pa-field-columns'),
            group = $element.data('pa-field-group');

          $element.addClass('pa-field-column');

          if (typeof track.group == 'undefined' || track.group != group)
          {
            track = {
              columns: 0,
              gutters: 0,
              group: group
            };
          }

          track = {
            columns: track.columns + columns,
            gutters: track.gutters + 1,
            group: group
          };

          if (track.columns >= total_columns)
          {
            $element
              .addClass('pa-field-column-last')
              .css({
                'margin-right': '0'
              });

            track = {
              columns: 0,
              gutters: 0,
              group: false
            };
          }
        });
    }
  };

  $.fn.pacolumns = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();

    return this.each(function()
    {
      var $this = $(this),
        data = $this.data('pacolumns'),
        options = typeof option === 'object' && option;

      if (!data)
      {
        $this.data('pacolumns', (data = new PaColumns(this, $.extend({}, $.fn.pacolumns.defaults, options, $(this).data()))));
      }

      if (typeof option === 'string')
      {
        data[option].apply(data, _arguments);
      }
    });
  };

  $.fn.pacolumns.defaults = {
    total_columns: 12,
    column_width: 7,
    gutter_width: 1.45,
    gutter_height: '7px',
  };

  $.fn.pacolumns.Constructor = PaColumns;



  /* --------------------------------------------------------------------------------
    Pa Media Upload - Handles the File Upload Field
  -------------------------------------------------------------------------------- */

  var PaMediaUpload = function(element, options)
  {
    this.element = $(element);
    this.options = options;
    this._init();
  };

  PaMediaUpload.prototype = {

    constructor: PaMediaUpload,

    _init: function()
    {
      var $this = this;

      $('.pa-upload-file-preview .attachments')
        .sortable({
          items: 'li.attachment',
          cursor: 'move',
          placeholder: 'pa-addmore-placeholder attachment',
          start: function(event, ui)
          {
            ui.placeholder.height(ui.item.height() - 2);
            ui.placeholder.width(ui.item.width());
          },
          update: function(event, ui)
          {
            var attachments = $(this).find('[data-attachment-id]'),
              input_name = $(attachments[0]).data('attachments'),
              input = $(':input[name="' + input_name + '"][type="hidden"]'),
              updates = [];

            attachments.each(function(i)
            {
              updates.push($(this).data('attachment-id'));
            });

            $(':input[name="' + input_name + '"][type="hidden"]:not(:first)').remove();

            input.val(updates.shift());

            for (var i = 0; i < updates.length; i++)
            {
              $(input
                  .first()
                  .clone()
                  .removeAttr('id')
                  .val(updates[i])
                ).insertAfter($(':input[name="' + input_name + '"][type="hidden"]:last'));
            }
          }
        });

      $(document).on('click', '.pa-upload-file-preview .attachment', function(event)
      {
        event.preventDefault();

        var $this = $(this);

        $this
          .parents('.pa-upload-file-preview:first')
          .prev('.pa-upload-file-button')
          .trigger('click', $this.find('.button-link').data('attachmentId'));
      });

      $(document)
        .off('click', '.pa-upload-file-preview .attachment .check')
        .on('click', '.pa-upload-file-preview .attachment .check', function(event)
        {
          event.preventDefault();

          var index = $($(this).parents('.attachments:eq(0)').children()).index($(this).parents('.attachment:eq(0)')),
            save = $(this).data('attachment-save'),
            name = $(this).data('attachments'),
            value = $(this).data('attachment-' + save);

          if ($(':input[name="' + name + '"][type="hidden"]').length > 1)
          {
            $(':input[name="' + name + '"][type="hidden"]:eq(' + index + ')').remove();
          }
          else
          {
            $(':input[name="' + name + '"][type="hidden"]:eq(' + index + ')').val('');
          }

          $(this).closest('.pa-upload-file-preview').trigger('pa:file:remove', index);

          $(this)
            .parents('.attachment:first')
            .remove();
        });

      $(document).on('click', '.pa-upload-file-button', function(event, attachmentId)
      {
        event.preventDefault();

        var button = $(this);

        if ($('*[id^="__wp-uploader-"]').length > 0)
        {
          $('*[id^="__wp-uploader-"]').remove();
        }

        var field = button.next('.pa-upload-file-preview').children(':input[type="hidden"]:eq(0)'),
          media_frame = wp.media.frames.file_frame = wp.media({
            title: button.attr('title'),
            button: {
              text: button.text(),
            },
            multiple: field.data('multiple')
          }),
          attachments = field.siblings('.attachments').find('.attachment'),
          ids = [];

        attachments.each(function(index, element) {
          ids.push($(element).find('.button-link').data('attachmentId'));
        });

        if (!!attachmentId)
        {
          media_frame.on('open', function()
          {
            var selection = media_frame.state().get('selection');
            selection.add(wp.media.attachment(attachmentId));
          });
        }

        media_frame.on('select', function()
        {
          var attachments = media_frame.state().get('selection'),
            preview_container = button.next('.pa-upload-file-preview'),
            input = preview_container.children(':input[type="hidden"]'),
            input_name = input.attr('name'),
            preview = preview_container.children('ul.attachments'),
            updates = [],
            check,
            style;

          if (!field.data('multiple') || field.data('multiple') === 'false')
          {
            preview.empty();
            if (input.length > 1)
            {
              input.slice(1).remove();
            }
            input = preview_container.children(':input[type="hidden"]:eq(0)');
            input.val('');
            ids = [];
          }

          attachments.map(function(attachment)
          {
            var display;
            attachment = attachment.toJSON();
            style = 'style="width: 150px;"';

            // Avoid attachment duplication
            if (-1 !== ids.indexOf(attachment.id))
            {
              return;
            }

            if (attachment.sizes)
            {
              display = attachment.sizes.full;

              if (attachment.sizes.thumbnail)
              {
                display = attachment.sizes.thumbnail;
              }
              else if (attachment.sizes.medium)
              {
                display = attachment.sizes.medium;
              }
              else if (attachment.sizes.large)
              {
                display = attachment.sizes.large;
              }

              if ($('body').hasClass('branch-4-2'))
              {
                check = '<a class="check" href="#" title="Deselect" tabindex="0" data-attachment-id="' + attachment.id + '" data-attachment-url="' + attachment.url + '" data-attachments="' + input.attr('name') + '"><div class="media-modal-icon"></div></a>';
              }
              else
              {
                check = '<button type="button" class="button-link check" data-attachment-id="' + attachment.id + '" data-attachment-url="' + attachment.url + '" data-attachments="' + input.attr('name') + '"><span class="media-modal-icon"></span><span class="screen-reader-text">Deselect</span></button>';
              }

              if (typeof $this.options.preview_size != 'undefined')
              {
                style = 'style="width: ' + display.width + ';"';
              }

              preview.append(
                $('<li class="attachment selected" ' + style + '>' +
                      '<div class="attachment-preview ' + (display.width > display.height ? 'landscape' : 'portrait') + '">' +
                        '<div class="thumbnail">' +
                          '<div class="centered">' +
                            '<a href="#">' +
                              '<img src="' + display.url + '" />' +
                            '</a>' +
                          '</div>' +
                        '</div>' +
                        check +
                      '</div>' +
                   '</li>'
                 )
              );
            }
            else
            {
              display = attachment;

              if ($('body').hasClass('branch-4-2'))
              {
                check = '<a class="check" href="#" title="Deselect" tabindex="0" data-attachment-id="' + attachment.id + '" data-attachment-url="' + attachment.url + '" data-attachments="' + input.attr('name') + '"><div class="media-modal-icon"></div></a>';
              }
              else
              {
                check = '<button type="button" class="button-link check" data-attachment-id="' + attachment.id + '" data-attachments="' + input.attr('name') + '"><span class="media-modal-icon"></span><span class="screen-reader-text">Deselect</span></button>';
              }

              preview.append(
                $('<li class="attachment selected" ' + style + '>' +
                      '<div class="attachment-preview attachment-preview-document type-' + display.type + ' subtype-' + display.subtype + ' landscape">' +
                         '<div class="thumbnail">' +
                           '<div class="centered">' +
                            '<img src="' + display.icon + '" class="icon" />' +
                          '</div>' +
                          '<div class="filename">' +
                             '<div>' + display.filename + '</div>' +
                          '</div>' +
                        '</div>' +
                        check +
                      '</div>' +
                   '</li>'
                 )
              );
            }

            updates.push(field.data('save') == 'url' ? attachment.url : attachment.id);
          });

          for (var i = 0; i < updates.length; i++)
          {
            if (input.first().val() == '')
            {
              input.first().val(updates[i]);
            }
            else
            {
              $(input
                  .first()
                  .clone()
                  .removeAttr('id')
                  .val(updates[i])
                ).insertAfter($(':input[name="' + input_name + '"]:last'));
            }
          }

          preview_container.trigger('pa:file:add', [updates]);

          preview_container.find('li.attachment').addClass('selected');
        });

        media_frame.open();
      });
    }
  };

  $.fn.pamediaupload = function(option)
  {
    var _arguments = Array.apply(null, arguments);
    _arguments.shift();

    return this.each(function()
    {
      var $this = $(this),
        data = $this.data('pamediaupload'),
        options = typeof option === 'object' && option;

      if (!data)
      {
        $this.data('pamediaupload', (data = new PaMediaUpload(this, $.extend({}, $.fn.pamediaupload.defaults, options, $(this).data()))));
      }

      if (typeof option === 'string')
      {
        data[option].apply(data, _arguments);
      }
    });
  };

  $.fn.pamediaupload.defaults = {
    multiple: true,
    save: 'id'
  };

  $.fn.pamediaupload.Constructor = PaMediaUpload;



  /* --------------------------------------------------------------------------------
    WordPress Updates
  -------------------------------------------------------------------------------- */

  // NOTE: Allow dynamically added editors to work properly with added buttons
  $(document).on('click', '.insert-media.add_media', function(event)
  {
    tinyMCE.get($(this).data('editor')).focus();
  });

  // NOTE: QTags should check the that the editor even has it enabled before trying to close anything
  window.QTags.closeAllTags = function(editor_id)
  {
    var editor = this.getInstance(editor_id);

    if (typeof editor != 'undefined')
    {
      window.QTags._close('', editor.canvas, editor);
    }
  };



  /* --------------------------------------------------------------------------------
    Additional Methods
  -------------------------------------------------------------------------------- */

  $.fn.reverse = function()
  {
    return Array.prototype.reverse.call(this);
  };

  $.intersect = function(a, b)
  {
    return $.grep(a, function(i)
    {
      return $.inArray(i, b) > -1;
    });
  };

  $.fn.commonAncestor = function()
  {
    var current = null,
      compare = this.eq(0).parents().reverse(),
      position = compare.length - 1;

    for (var i = 1, j = this.length; i < j && position > 0; i += 1)
    {
      current = this.eq(i).parents().reverse();
      position = Math.min(position, current.length - 1);

      while (compare[position] !== current[position])
      {
        position -= 1;
      }
    }

    return compare.eq(position);
  };

  $.fn.actual = function(dimension)
  {
    var $wrap = $('<div />').appendTo($('body')),
      $clone, dimension;

    $wrap.css({
      'position': 'absolute',
      'left': '-9999999px',
      'visibility': 'hidden',
      'display': 'block'
    });

    $clone = $(this).clone().appendTo($wrap);

    dimension = typeof dimension != 'undefined' && dimension == 'width' ? $clone.width() : $clone.height();

    $wrap.remove();

    return dimension;
  };



})(jQuery, window, document);
