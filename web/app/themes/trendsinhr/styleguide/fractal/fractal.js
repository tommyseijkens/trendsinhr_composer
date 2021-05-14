'use strict';

/*
* Require the path module
*/
const path = require('path');

/*
 * Require the Fractal module
 */
const fractal = module.exports = require('@frctl/fractal').create();

/*
 * Give your project a title.
 */
fractal.set('project.title', 'Trends in HR');

/*
 * Tell Fractal where to look for components.
 */
fractal.components.set('path', path.join(__dirname, 'components'));
/*
 * Tell Fractal where to look for documentation pages.
 */
fractal.docs.set('path', path.join(__dirname, 'docs'));

/*
 * Tell the Fractal web preview plugin where to look for static assets.
 */
fractal.web.set('static.path', path.join(__dirname, '../assets/'));

// fractal.components.set('default.preview', '@preview');

fractal.web.set('builder.dest', './build');

fractal.docs.set('statuses', {
  draft: {
    label: 'Draft',
    description: 'Work in progress.',
    color: '#FF3333'
  },
  ready: {
    label: 'Ready',
    description: 'Ready for referencing.',
    color: '#29CC29'
  }
});

fractal.components.set('statuses', {
  prototype: {
    label: "Prototype",
      description: "Do not implement.",
      color: "#e71234"
  },
  wip: {
    label: "WIP",
      description: "Work in progress. Implement with caution.",
      color: "#336699"
  },
  ready: {
    label: "Ready",
      description: "Ready to implement.",
      color: "#29CC29"
  },
  bootstrap: {
    label: "Bootstrap default",
    description: "Default Bootstrap components.",
    color: "#29CC29"
  },
  project: {
    label: "Project",
    description: "project component.",
    color: "#000060"
  }
});

fractal.components.set('default.status', 'bootstrap');

const mandelbrot = require('@frctl/mandelbrot'); // require the Mandelbrot theme module

// create a new instance with custom config options
const drigroTheme = mandelbrot({
  skin: "black",
  favicon: "/fractal/favicon.ico",
  styles: [
    "default",
    "/fractal/fractal_style.css"
  ]
  // any other theme configuration values here
});

fractal.web.theme(drigroTheme); // tell Fractal to use the configured theme by default
