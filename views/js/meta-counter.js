/**
 * Zeyvro Meta Counter — SEO character counter for PrestaShop backoffice.
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   MIT
 */
(function () {
    'use strict';

    var LIMIT_TITLE = 60;
    var LIMIT_DESC = 160;

    function isMetaTitle(el) {
        var k = ((el.name || '') + ' ' + (el.id || '')).toLowerCase();
        return k.indexOf('meta_title') !== -1 || k.indexOf('metatitle') !== -1;
    }
    function isMetaDesc(el) {
        var k = ((el.name || '') + ' ' + (el.id || '')).toLowerCase();
        return k.indexOf('meta_description') !== -1 || k.indexOf('metadescription') !== -1;
    }
    function classify(el) {
        if (isMetaTitle(el)) return { max: LIMIT_TITLE };
        if (isMetaDesc(el))  return { max: LIMIT_DESC };
        return null;
    }
    function findFields() {
        return document.querySelectorAll(
            'input[name*="meta_title"], input[id*="meta_title"], '
            + 'textarea[name*="meta_description"], textarea[id*="meta_description"], '
            + 'input[name*="meta_description"], input[id*="meta_description"]'
        );
    }
    function attach(el) {
        if (el.dataset.zvCounter === '1') return;
        var info = classify(el);
        if (!info) return;
        el.dataset.zvCounter = '1';

        var counter = document.createElement('small');
        counter.className = 'zv-meta-counter';
        if (el.nextSibling) {
            el.parentNode.insertBefore(counter, el.nextSibling);
        } else {
            el.parentNode.appendChild(counter);
        }

        function update() {
            var len = (el.value || '').length;
            var left = info.max - len;
            counter.textContent = 'SEO: ' + len + ' / ' + info.max;
            counter.classList.remove('zv-meta-counter--ok', 'zv-meta-counter--warn', 'zv-meta-counter--over');
            if (left < 0) {
                counter.classList.add('zv-meta-counter--over');
            } else if (left <= 10) {
                counter.classList.add('zv-meta-counter--warn');
            } else {
                counter.classList.add('zv-meta-counter--ok');
            }
        }
        el.addEventListener('input', update);
        el.addEventListener('change', update);
        update();
    }
    function scan() {
        var fields = findFields();
        for (var i = 0; i < fields.length; i++) {
            attach(fields[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', scan);
    } else {
        scan();
    }

    // Observer for V2 product form (Symfony) which loads the SEO tab lazily
    var observer = new MutationObserver(function () { scan(); });
    observer.observe(document.documentElement, { childList: true, subtree: true });
})();
