(function () {
  const A = window.AGOS; if (!A) return;
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];
  const esc = s => String(s).replace(/[&<>"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));
  const kv = pairs => '<dl class="kv">' + pairs.map(([k, v]) => '<dt>' + k + '</dt><dd>' + esc(v) + '</dd>').join('') + '</dl>';

  const list = $('#reportList');
  if (list) {
    let filter = 'all';
    const cards = () => $$('.rcard', list);

    function apply() {
      let shown = 0;
      cards().forEach(c => { const ok = filter === 'all' || c.dataset.status === filter; c.hidden = !ok; if (ok) shown++; });
      const e = $('#reportEmpty'); e.hidden = shown > 0;
      e.textContent = filter === 'verified' ? 'No verified reports yet. Reports you verify appear here.'
        : filter === 'pending' ? 'No reports waiting for review.' : 'No reports to show.';
    }
    function recount() {
      const n = cards().filter(c => c.dataset.status === 'pending').length;
      $('#pendingTab').textContent = 'Pending (' + n + ')';
      const nb = $('#navBadge'); if (nb) { n > 0 ? nb.textContent = n : nb.remove(); }
      if (n === 0) $('#notifDot')?.remove();
      apply();
    }

    $$('[data-rfilter]').forEach(b => b.addEventListener('click', () => {
      filter = b.dataset.rfilter;
      $$('[data-rfilter]').forEach(x => x.classList.toggle('active', x === b));
      apply();
    }));

    list.addEventListener('click', e => {
      const b = e.target.closest('[data-review]'); if (!b) return;
      const c = b.closest('.rcard'), d = c.dataset;
      A.openModal({
        title: d.title,
        body: kv([['Water level', d.level], ['Road', d.road], ['Reported by', d.source], ['Time', d.time], ['Attachment', d.media]]),
        confirm: 'Verify report',
        action: () => {
          c.dataset.status = 'verified';
          $('.rcard-action', c).innerHTML = '<span class="status-tag st-verified">Verified</span>';
          A.toast('Report verified.'); recount();
        },
        alt: { label: 'Reject', action: () => { c.remove(); A.toast('Report rejected.', 'warn'); recount(); } }
      });
    });
    apply();
  }

  const ar = $('#arTable');
  if (ar) {
    let cur = null;
    const setRadio = (name, val) => $$('input[name=' + name + ']').forEach(r => r.checked = r.value === val);
    const getRadio = name => ($('input[name=' + name + ']:checked') || {}).value || '';
    function select(tr, scroll) {
      cur = tr;
      $$('tbody tr', ar).forEach(r => r.classList.toggle('sel', r === tr));
      $('#editTitle').textContent = 'Update ' + tr.dataset.area;
      $('#arWater').value = tr.dataset.water;
      setRadio('road', tr.dataset.road); setRadio('area', tr.dataset.status);
      if (scroll) $('#editPanel').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    ar.addEventListener('click', e => { const b = e.target.closest('[data-edit]'); if (b) select(b.closest('tr'), true); });
    $('#arSave').addEventListener('click', () => {
      if (!cur) return;
      const w = $('#arWater').value.trim() || 'None';
      cur.dataset.water = w; cur.dataset.road = getRadio('road'); cur.dataset.status = getRadio('area');
      $('.c-water', cur).textContent = w;
      $('.c-road', cur).textContent = cur.dataset.road;
      $('.c-updated', cur).textContent = new Date().toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
      A.toast(cur.dataset.area + ' updated.');
    });
    select($('tbody tr', ar), false);
  }

  const form = $('#cityAlertForm');
  if (form) {
    const pairs = [['alLoc', 'pvLoc'], ['alDepth', 'pvDepth'], ['alRoad', 'pvRoad']];
    const sync = () => pairs.forEach(([i, o]) => { $('#' + o).textContent = $('#' + i).value || '-'; });
    form.addEventListener('input', sync); form.addEventListener('change', sync); sync();

    form.addEventListener('submit', e => {
      e.preventDefault();
      const groups = $$('input[name=grp]:checked').length;
      if (!$('#alLoc').value.trim() || !$('#alDepth').value.trim()) { A.toast('Enter a location and depth first.', 'warn'); return; }
      if (!groups) { A.toast('Choose at least one group to send to.', 'warn'); return; }
      A.openModal({
        title: 'Publish this alert?',
        body: '<p><strong>' + esc($('#alLoc').value) + '</strong></p><p class="muted">Depth ' + esc($('#alDepth').value) + ', ' + esc($('#alRoad').value) + '. Sending to ' + groups + ' group' + (groups > 1 ? 's' : '') + (($('#alMayor').checked) ? ' and the City Mayor' : '') + '.</p>',
        confirm: 'Publish alert',
        action: () => A.toast('Alert published.')
      });
    });
    $('#viewRoute').addEventListener('click', () => A.toast('Safe routes open in the mobile app. This is a preview.', 'warn'));
  }

  const rt = $('#rTable');
  if (rt) {
    const rows = $$('tbody tr', rt);
    function filt() {
      const b = $('#rBrgy').value, f = $('#rFrom').value, t = $('#rTo').value, s = $('#rStatus').value;
      let n = 0;
      rows.forEach(r => {
        const ok = (!b || r.dataset.place === b) && (!f || r.dataset.date >= f) && (!t || r.dataset.date <= t) && (!s || r.dataset.report === s);
        r.hidden = !ok; if (ok) n++;
      });
      $('#rEmpty').hidden = n > 0;
    }
    $('#rSearch').addEventListener('click', filt);
    rt.addEventListener('click', e => {
      const b = e.target.closest('[data-view]'); if (!b) return;
      const c = $$('td', b.closest('tr')).map(td => td.textContent.trim());
      A.openModal({ title: c[1], body: kv([['Date and time', c[0]], ['Water', c[2]], ['Road', c[3]], ['Report', c[4]], ['Alert', c[5]]]) });
    });
  }
})();
