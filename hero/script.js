/**
 * Weaverly Hero – Native JavaScript
 *
 * Handles:
 *  1. Tab click interactions (active state, panel switching)
 *  2. Dynamic color-palette transitions (CSS variable injection)
 *  3. Smooth gradient-text re-render on palette change
 */

(function () {
  'use strict';

  /* ─────────────────────────────────────────────────────────────
     COLOR PALETTES
     Each palette maps to one of the four navigation tabs.
     Colors cascade through CSS variables on :root.
     ───────────────────────────────────────────────────────────── */
  const PALETTES = [
    {
      // 0 · Pixel Streaming – Teal / Deep Blue
      blob1: '#0d9488',          // teal-600
      blob2: '#1d4ed8',          // blue-700
      blob3: '#6366f1',          // indigo-500
      blob4: '#0f172a',          // slate-900
      accentColor: '#2dd4bf',    // teal-400
      gradientFrom: '#2dd4bf',   // teal-400
      gradientTo:   '#818cf8',   // indigo-400
      tabGlow:      'rgba(45, 212, 191, 0.30)',
    },
    {
      // 1 · Machine Learning – Purple / Violet
      blob1: '#7c3aed',          // violet-600
      blob2: '#4c1d95',          // violet-900
      blob3: '#a855f7',          // purple-500
      blob4: '#1e1b4b',          // indigo-950
      accentColor: '#c084fc',    // purple-400
      gradientFrom: '#c084fc',   // purple-400
      gradientTo:   '#818cf8',   // indigo-400
      tabGlow:      'rgba(192, 132, 252, 0.30)',
    },
    {
      // 2 · Inference Service – Orange / Amber
      blob1: '#c2410c',          // orange-700
      blob2: '#92400e',          // amber-800
      blob3: '#ea580c',          // orange-600
      blob4: '#431407',          // orange-950
      accentColor: '#fb923c',    // orange-400
      gradientFrom: '#fb923c',   // orange-400
      gradientTo:   '#fbbf24',   // amber-400
      tabGlow:      'rgba(251, 146, 60, 0.30)',
    },
    {
      // 3 · VFX – Emerald / Cyan
      blob1: '#059669',          // emerald-600
      blob2: '#0e7490',          // cyan-700
      blob3: '#10b981',          // emerald-500
      blob4: '#022c22',          // emerald-950
      accentColor: '#34d399',    // emerald-400
      gradientFrom: '#34d399',   // emerald-400
      gradientTo:   '#22d3ee',   // cyan-400
      tabGlow:      'rgba(52, 211, 153, 0.30)',
    },
  ];

  /* ─────────────────────────────────────────────────────────────
     DOM REFERENCES
     ───────────────────────────────────────────────────────────── */
  const root      = document.documentElement;
  const tabBtns   = document.querySelectorAll('.tab-btn');
  const tabPanels = document.querySelectorAll('.tab-panel');

  /* ─────────────────────────────────────────────────────────────
     APPLY PALETTE
     Sets CSS custom properties on :root so blobs, gradient-text,
     and tab-glow all transition smoothly via existing CSS rules.
     ───────────────────────────────────────────────────────────── */
  function applyPalette(paletteIndex) {
    const p = PALETTES[paletteIndex];
    if (!p) return;

    root.style.setProperty('--blob1-color',        p.blob1);
    root.style.setProperty('--blob2-color',        p.blob2);
    root.style.setProperty('--blob3-color',        p.blob3);
    root.style.setProperty('--blob4-color',        p.blob4);
    root.style.setProperty('--accent-color',       p.accentColor);
    root.style.setProperty('--tab-glow',           p.tabGlow);

    // Gradient text: patch inline style on the .gradient-text span so the
    // browser recalculates the background-image gradient immediately and
    // the CSS transition on the property plays through.
    updateGradientText(p.gradientFrom, p.gradientTo);
  }

  /* Update the gradient-text element with the new palette colors.
     We toggle a CSS class to trigger a repaint-safe re-render. */
  function updateGradientText(from, to) {
    const el = document.querySelector('.gradient-text');
    if (!el) return;

    // Apply the new gradient directly
    el.style.backgroundImage = `linear-gradient(135deg, ${from} 0%, ${to} 100%)`;
  }

  /* ─────────────────────────────────────────────────────────────
     ACTIVATE TAB
     ───────────────────────────────────────────────────────────── */
  function activateTab(btn) {
    const tabId      = btn.dataset.tab;
    const paletteIdx = parseInt(btn.dataset.palette, 10);

    // Update tab button states
    tabBtns.forEach(function (b) {
      const isActive = b === btn;
      b.classList.toggle('active', isActive);
      b.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });

    // Update tab panel visibility
    tabPanels.forEach(function (panel) {
      const isTarget = panel.id === 'panel-' + tabId;
      panel.classList.toggle('active', isTarget);

      // Reset animation so fadeSlideUp replays on re-activation
      if (isTarget) {
        panel.style.animation = 'none';
        // Trigger reflow
        void panel.offsetHeight; // eslint-disable-line no-void
        panel.style.animation = '';
      }
    });

    // Transition to new color palette
    applyPalette(paletteIdx);
  }

  /* ─────────────────────────────────────────────────────────────
     EVENT LISTENERS
     ───────────────────────────────────────────────────────────── */
  tabBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      activateTab(btn);
    });

    // Keyboard accessibility: activate on Enter / Space
    btn.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        activateTab(btn);
      }
    });
  });

  /* ─────────────────────────────────────────────────────────────
     INIT – Apply default palette (0) on first load
     ───────────────────────────────────────────────────────────── */
  applyPalette(0);

})();
