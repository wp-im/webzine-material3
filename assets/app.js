/* Progressive enhancements only; content and links are rendered by WordPress. */
(() => {
  'use strict';
  const cfg = window.Webzine || {}, key = cfg.namespace || 'webzine-local';
  const $ = (s, root = document) => root.querySelector(s);
  const $$ = (s, root = document) => [...root.querySelectorAll(s)];
  let memory = [], saved = [], lastFocus, timer;
  const toast = text => { const out = $('#wz-toast'); if (!out) return; out.textContent = text; out.classList.add('is-visible'); clearTimeout(timer); timer = setTimeout(() => out.classList.remove('is-visible'), 3000); };
  try { const data = JSON.parse(localStorage.getItem(key + ':saved') || '[]'); if (Array.isArray(data)) saved = data.filter(x => x && Number.isInteger(x.id) && typeof x.url === 'string' && typeof x.title === 'string').filter(x => { try { return new URL(x.url).origin === location.origin; } catch { return false; } }); } catch {}
  const sync = () => $$('[data-save]').forEach(b => { const active = saved.some(x => x.id === Number(b.dataset.save)); b.classList.toggle('is-saved', active); b.setAttribute('aria-pressed', String(active)); });
  const render = () => { const out = $('#wz-saved-list'); if (!out) return; out.replaceChildren(); if (!saved.length) { const p = document.createElement('p'); p.textContent = cfg.empty; out.append(p); return; } saved.forEach(item => { const a = document.createElement('a'); a.href = item.url; a.textContent = item.title; a.className = 'wz-saved-item'; out.append(a); }); };
  const close = dialog => { dialog.close(); lastFocus?.focus(); };
  const open = id => { const dialog = document.getElementById(id); if (!dialog || !dialog.showModal) return; $$('dialog[open]').forEach(d => d.close()); lastFocus = document.activeElement; if (id === 'wz-saved') render(); dialog.showModal(); dialog.querySelector('input,button,a')?.focus(); };
  document.addEventListener('click', async e => {
    const el = e.target.closest('button,a'); if (!el) return;
    const href = el.getAttribute('href');
    if (el.dataset.open || (['#wz-search', '#wz-saved', '#wz-drawer'].includes(href) && $(href))) { e.preventDefault(); open(el.dataset.open || href.slice(1)); }
    if (el.hasAttribute('data-close')) close(el.closest('dialog'));
    if (el.hasAttribute('data-save')) {
      const id = Number(el.dataset.save), exists = saved.some(x => x.id === id);
      saved = exists ? saved.filter(x => x.id !== id) : [{id, title: el.dataset.title, url: el.dataset.url}, ...saved].slice(0, 300);
      memory = saved;
      try { localStorage.setItem(key + ':saved', JSON.stringify(saved)); toast(exists ? cfg.removed : cfg.saved); } catch { saved = memory; toast(cfg.unavailable); }
      sync();
    }
    if (el.hasAttribute('data-share')) {
      try { if (navigator.share) await navigator.share({title: document.title, url: location.href}); else { await navigator.clipboard.writeText(location.href); toast(cfg.copied); } } catch (err) { if (err.name !== 'AbortError') toast(cfg.copy); }
    }
    if (el.hasAttribute('data-print')) window.print();
    if (el.dataset.font !== undefined) {
      const prose = $('#wz-prose'); if (prose) { const size = Number(el.dataset.font); prose.style.setProperty('--wz-reader-adjust', String(1 + size * 0.12)); try { localStorage.setItem(key + ':font', String(size)); } catch {} }
    }
  });
  $$('dialog').forEach(d => { d.addEventListener('click', e => { if (e.target !== d) return; const r = d.getBoundingClientRect(); if (e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r.bottom) close(d); }); d.addEventListener('cancel', () => lastFocus?.focus()); });
  document.addEventListener('keydown', e => { if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') { e.preventDefault(); open('wz-search'); } });
  const prose = $('#wz-prose'), toc = $('#wz-toc'), progress = $('#wz-progress'), scroller = $('#wz-scroll');
  if (prose) {
    try { const font = Number(localStorage.getItem(key + ':font')); if ([-1,0,1].includes(font)) prose.style.setProperty('--wz-reader-adjust', String(1 + font * 0.12)); } catch {}
    if (toc) { const headings = $$('h2,h3', prose); if (headings.length) { headings.forEach((h, i) => { if (!h.id) h.id = 'wz-section-' + (i + 1); const a = document.createElement('a'); a.href = '#' + h.id; a.textContent = h.textContent; a.className = h.tagName === 'H3' ? 'wz-toc-child' : ''; toc.querySelector('nav').append(a); }); toc.hidden = false; } }
    const update = () => { if (!progress) return; const r = prose.getBoundingClientRect(), viewport = scroller && getComputedStyle(scroller).overflowY === 'auto' ? scroller.getBoundingClientRect() : {top: 0, height: innerHeight}; progress.value = Math.max(0, Math.min(100, (viewport.top + viewport.height * 0.5 - r.top) / Math.max(1, r.height) * 100)); };
    window.addEventListener('scroll', update, {passive: true}); scroller?.addEventListener('scroll', update, {passive: true}); window.addEventListener('resize', update); update();
  }
  sync();
})();
