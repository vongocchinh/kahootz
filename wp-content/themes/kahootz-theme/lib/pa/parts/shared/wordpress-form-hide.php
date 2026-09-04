
<?php if ($type == 'user'): ?>

  <style type="text/css">

    body.pa-workflow-active.user-edit-php #your-profile .pa-meta-box-title,
    body.pa-workflow-active.profile-php #your-profile .pa-meta-box-title,
    body.pa-workflow-active.user-edit-php #your-profile .pa-form-table,
    body.pa-workflow-active.profile-php #your-profile .pa-form-table,
    body.pa-workflow-active.user-edit-php #your-profile p.submit,
    body.pa-workflow-active.profile-php #your-profile p.submit {
      display: block;
    }

      body.pa-workflow-active.user-edit-php #your-profile > *,
      body.pa-workflow-active.profile-php #your-profile > * {
        display: none;
      }

      body.pa-workflow-active.user-edit-php #profile-page > h1 {
        display: none;
      }

      body.pa-workflow-active.user-edit-php #your-profile > .pa-meta-box,
      body.pa-workflow-active.profile-php #your-profile > .pa-meta-box {
        display: block;
      }

  </style>

<?php elseif ($type == 'media'): ?>

  <style type="text/css">

    body.pa-workflow-active.post_type-attachment .wp_attachment_holder,
    body.pa-workflow-active.post_type-attachment .wp_attachment_details {
      display: none;
    }

  </style>

<?php elseif ($type == 'term'): ?>

  <style type="text/css">

    body.pa-workflow-active.edit-tags-php .term-name-wrap,
    body.pa-workflow-active.edit-tags-php .term-slug-wrap,
    body.pa-workflow-active.edit-tags-php .term-parent-wrap,
    body.pa-workflow-active.edit-tags-php .term-description-wrap,
		body.pa-workflow-active.term-php .term-name-wrap,
    body.pa-workflow-active.term-php .term-slug-wrap,
    body.pa-workflow-active.term-php .term-parent-wrap,
    body.pa-workflow-active.term-php .term-description-wrap  {
      display: none;
    }

  </style>

<?php endif; ?>
