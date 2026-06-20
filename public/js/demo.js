/* ============================================
   DEMO APPS — SHARED SCRIPTS
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {

    /* ---------- FINANCE TRACKER: TX TABS ---------- */
    const tabButtons = document.querySelectorAll('.tab-btn');

    if (tabButtons.length) {
        tabButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const type = btn.dataset.tabType;
                tabButtons.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');

                document.querySelectorAll('.tx-item').forEach(function (item) {
                    item.style.display = (type === 'all' || item.dataset.type === type) ? '' : 'none';
                });
            });
        });
    }

    /* ---------- WATER TRACKER: TOGGLE CUSTOMER ---------- */
    document.querySelectorAll('.customer-header').forEach(function (header) {
        header.addEventListener('click', function () {
            const targetId = header.dataset.customerTarget;
            const el = document.getElementById(targetId);
            if (el) {
                el.style.display = (el.style.display === 'none') ? '' : 'none';
            }
        });
    });

});