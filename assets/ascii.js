(function () {
    "use strict";

    var CHARS = ["·", "•", "◆", "×", "+"];
    var COLS = 34;
    var ROWS = 30;

    function densityAt(c, r, cols, rows, cx, cy, spread) {
        var dx = (c - cx * cols) / (spread * cols);
        var dy = (r - cy * rows) / (spread * rows);
        var d = Math.sqrt(dx * dx + dy * dy);
        return Math.max(0, 0.9 - d);
    }

    function randomChar() {
        return CHARS[Math.floor(Math.random() * CHARS.length)];
    }

    function buildCloud(cx, cy, spread) {
        var lines = [];
        for (var r = 0; r < ROWS; r++) {
            var line = "";
            for (var c = 0; c < COLS; c++) {
                var density = densityAt(c, r, COLS, ROWS, cx, cy, spread);
                line += Math.random() < density * 0.55 ? randomChar() : " ";
            }
            lines.push(line);
        }
        return lines;
    }

    function glitchTick(el, lines) {
        var flips = 8 + Math.floor(Math.random() * 14);
        for (var i = 0; i < flips; i++) {
            var r = Math.floor(Math.random() * lines.length);
            var line = lines[r];
            if (!line) continue;
            var c = Math.floor(Math.random() * line.length);
            var ch = line.charAt(c) === " " ? randomChar() : " ";
            lines[r] = line.slice(0, c) + ch + line.slice(c + 1);
        }
        el.textContent = lines.join("\n");
    }

    function initCloud(id, cx, cy, spread) {
        var el = document.getElementById(id);
        if (!el) return;

        var lines = buildCloud(cx, cy, spread);
        el.textContent = lines.join("\n");

        setInterval(function () {
            glitchTick(el, lines);
        }, 130);
    }

    document.addEventListener("DOMContentLoaded", function () {
        initCloud("ascii-cloud-left", 0.72, 0.5, 0.6);
        initCloud("ascii-cloud-right", 0.28, 0.5, 0.6);
    });
})();
