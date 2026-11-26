(function () {
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];

  const topDate = $('#topbarDate');
  if (topDate) {
    const updateClock = () => {
      const now = new Date();
      const d = now.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
      const t = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
      topDate.textContent = d + ' \u00B7 ' + t;
    };
    updateClock();
    setInterval(updateClock, 15000);
  }

  function toast(msg, type = 'ok') {
    const el = document.createElement('div');
    el.className = 'toast ' + type;
    el.textContent = msg;
    $('#toasts').appendChild(el);
    setTimeout(() => el.remove(), 3500);
  }

  let onConfirm = null, onAlt = null;
  function openModal({ title, body, confirm = 'Confirm', danger = false, action, alt }) {
    $('#modalTitle').textContent = title;
    $('#modalBody').innerHTML = body;
    const btn = $('#modalConfirm');
    btn.textContent = confirm;
    btn.className = 'btn ' + (danger ? 'btn-red' : 'btn-primary');
    btn.hidden = !action;
    onConfirm = action || null;
    const altBtn = $('#modalAlt');
    if (altBtn) { altBtn.hidden = !alt; if (alt) altBtn.textContent = alt.label; onAlt = alt ? alt.action : null; }
    $('#modal').hidden = false;
    (btn.hidden ? $('[data-action=modal-cancel]') : btn).focus();
  }
  function closeModal() { $('#modal').hidden = true; onConfirm = null; onAlt = null; }
  function closeMenus(exceptId) {
    ['bellMenu', 'userMenu'].forEach(id => {
      if (id === exceptId) return;
      const m = $('#' + id);
      if (m) m.hidden = true;
    });
    const ub = $('[data-action="user-menu"]');
    if (ub && exceptId !== 'userMenu') ub.setAttribute('aria-expanded', 'false');
  }
  document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeModal(); closeMenus(); } });
  $('#modal')?.addEventListener('click', e => { if (e.target.id === 'modal') closeModal(); });

  function clearPending(label) {
    const c = $('#pendingCount'); if (c) c.textContent = 'No reports in review';
    const b = $('#navBadge'); if (b) b.remove();
    const n = $('#notifDot'); if (n) n.remove();
    const box = $('#decisionBox');
    if (box) box.innerHTML = '<div class="decision-text"><strong>' + label + '</strong> You can review it later under Records.</div><a class="btn btn-ghost" href="records.php">Open records</a>';
  }

  document.addEventListener('click', e => {
    const t = e.target.closest('[data-action]');
    if (!e.target.closest('.menu-wrap')) closeMenus();
    if (!t) return;
    const a = t.dataset.action;

    if (a === 'bell') {
      closeMenus('bellMenu');
      const m = $('#bellMenu'); if (m) m.hidden = !m.hidden;
    }
    if (a === 'user-menu') {
      closeMenus('userMenu');
      const m = $('#userMenu');
      if (m) { m.hidden = !m.hidden; t.setAttribute('aria-expanded', String(!m.hidden)); }
    }
    if (a === 'modal-cancel') closeModal();
    if (a === 'modal-confirm' && onConfirm) { const fn = onConfirm; closeModal(); fn(); }
    if (a === 'modal-alt' && onAlt) { const fn = onAlt; closeModal(); fn(); }

    if (a === 'refresh') {
      t.disabled = true; t.textContent = 'Refreshing...';
      setTimeout(() => { t.disabled = false; t.textContent = 'Refresh feed'; toast('Feed is up to date.'); }, 900);
    }
    if (a === 'video') {
      e.preventDefault();
      openModal({ title: 'Video clip', body: '<div class="video-ph">Video preview placeholder</div><p class="muted small">Resident report #4902, 3:45 PM</p>' });
    }
    if (a === 'verify') openModal({
      title: 'Verify this report?',
      body: '<p>Lopez Jaena, 0.5 m, not passable. It will appear on the hazard map and the community alert will be sent.</p>',
      confirm: 'Verify report',
      action: () => { clearPending('Report verified and alert sent.'); toast('Report verified. Alert sent to the community.'); }
    });
    if (a === 'reject') openModal({
      title: 'Reject this report?',
      body: '<label class="small" for="rsn">Reason</label><select id="rsn" class="select"><option>Water level does not match the video</option><option>Duplicate report</option><option>Location is incorrect</option><option>Other</option></select>',
      confirm: 'Reject report', danger: true,
      action: () => { clearPending('Report rejected.'); toast('Report rejected.', 'warn'); }
    });
    if (a === 'use-template') $('#msg').value = 'Flood alert: Lopez Jaena (Zone 3) has 0.5 m of water. The road is not passable. Please avoid the area and use another route.';
    if (a === 'export') toast('Export started. This is a preview, no file is created yet.', 'warn');
  });

  $$('[data-pin]').forEach(p => p.addEventListener('click', () => {
    $$('.pin').forEach(x => x.classList.remove('sel')); p.classList.add('sel');
    $('#pinDetail').innerHTML = '<h2>' + p.dataset.name + '</h2><span class="status-tag st-' + p.dataset.pin + '">' + p.dataset.sev + ' severity</span>' +
      '<dl class="kv"><dt>Water level:</dt><dd>' + p.dataset.level + '</dd><dt>Road status:</dt><dd>' + p.dataset.road + '</dd></dl>';
  }));
  $$('[data-filter-pin]').forEach(b => b.addEventListener('click', () => {
    $$('[data-filter-pin]').forEach(x => x.classList.toggle('active', x === b));
    $$('.pin').forEach(p => p.hidden = b.dataset.filterPin !== 'all' && p.dataset.pin !== b.dataset.filterPin);
  }));

  $('#alertForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const msg = $('#msg').value.trim();
    if (!msg) { toast('Write a message before sending.', 'warn'); $('#msg').focus(); return; }
    openModal({
      title: 'Send this alert?', body: '<p>To: <strong>' + $('#zone').value + '</strong></p><p class="muted">' + msg.replace(/</g, '&lt;') + '</p>',
      confirm: 'Send alert',
      action: () => {
        const li = document.createElement('li');
        li.innerHTML = '<strong>' + $('#zone').value + ':</strong> ' + msg.replace(/</g, '&lt;') + ' <span class="muted small">Just now</span>';
        $('#sentList').prepend(li); $('#msg').value = ''; toast('Alert sent.');
      }
    });
  });

  const rows = $$('#recTable tbody tr');
  function filterRows() {
    const q = ($('#recSearch')?.value || '').toLowerCase(), s = $('#recStatus')?.value || '';
    let shown = 0;
    rows.forEach(r => {
      const ok = r.textContent.toLowerCase().includes(q) && (!s || r.querySelector('.status-tag').textContent === s);
      r.hidden = !ok; if (ok) shown++;
    });
    const em = $('#recEmpty'); if (em) em.hidden = shown > 0;
  }
  $('#recSearch')?.addEventListener('input', filterRows);
  $('#recStatus')?.addEventListener('change', filterRows);
  window.AGOS = { toast, openModal, closeModal };
})();
