/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        border: 'hsl(var(--border))',
        input: 'hsl(var(--input))',
        ring: 'hsl(var(--ring))',
        background: 'hsl(var(--background))',
        foreground: 'hsl(var(--foreground))',
        muted: 'hsl(var(--muted))',
        primary: {
          DEFAULT: 'hsl(var(--primary))',
          foreground: 'hsl(var(--primary-foreground))',
        },
        accent: {
          DEFAULT: 'hsl(var(--accent))',
          foreground: 'hsl(var(--accent-foreground))',
        },
        destructive: {
          DEFAULT: 'hsl(var(--destructive))',
          foreground: 'hsl(var(--destructive-foreground))',
        },
        'page-base': 'hsl(var(--page-base))',
        'page-section': 'hsl(var(--page-section))',
        card: 'hsl(var(--card))',
        'card-elevated': 'hsl(var(--card-elevated))',
        panel: 'hsl(var(--panel))',
        'panel-highlight': 'hsl(var(--panel-highlight))',
        'footer-bar': 'hsl(var(--footer-bar))',
        'button-secondary': 'hsl(var(--button-secondary))',
      },
      fontFamily: {
        sans: ['system-ui', 'sans-serif'],
        display: ["'Montserrat'", 'system-ui', 'sans-serif'],
        body: ["'Montserrat'", 'system-ui', 'sans-serif'],
      },
      backgroundImage: {
        'grad-page-background': 'linear-gradient(180deg, #020611 0%, #040A14 45%, #030811 100%)',
        'grad-card-sheen': 'linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%)',
        'grad-cta-primary': 'linear-gradient(180deg, #FF7A1A 0%, #FF6A00 100%)',
      },
    },
  },
  plugins: [],
}
