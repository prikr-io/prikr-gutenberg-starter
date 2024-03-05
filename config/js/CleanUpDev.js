const fs = require('fs');
const path = require('path');

const directory = './public/js'; // Replace with your actual output directory

fs.readdir(directory, (err, files) => {
  if (err) throw err;

  for (const file of files) {
    if (file.endsWith('.hot-update.js') || file.endsWith('.hot-update.json') || file.endsWith('hot-update.map') || file.endsWith('.hot-update.LICENSE.txt')) {
      fs.unlink(path.join(directory, file), err => {
        if (err) throw err;
      });
    }
  }
});