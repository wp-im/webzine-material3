/* Apply a chosen palette through native settings; every role remains editable. */
(() => {
  'use strict';
  wp.customize('wz_color_scheme', setting => {
    setting.bind(scheme => {
      const palette = window.WebzineCustomize?.palettes?.[scheme];
      if (!palette) return;
      Object.entries(palette).forEach(([key, value]) => {
        wp.customize('wz_' + key, color => color.set(value));
      });
    });
  });
})();
