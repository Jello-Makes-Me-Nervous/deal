/**
 * Dynamically import only the required Font Awesome icon sets.
 * This avoids loading the massive all.js bundle at initial render.
 */

import('./fontawesome.js');

const route = window.location.pathname;

if (route.includes('admin')) {
  // Admin pages tend to use solid and regular icons
  Promise.all([
    import('./solid.js'),
    import('./regular.js')
  ]);
} else {
  // Public pages primarily rely on brand icons
  import('./brands.js');
}
