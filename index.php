<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGOS | CDRRMO Flood Monitoring Dashboard</title>
    <style>
        :root {
            --blue: #1d4ed8;
            --navy: #1e3a8a;
            --tint: #eff6ff;
            --white: #ffffff;
            --bg: #f8fafc;
            --text: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); }
        header {
            background: var(--white); border-bottom: 1px solid var(--line);
            padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center;
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; }
        .logo {
            width: 34px; height: 34px; background: var(--blue); color: var(--white);
            border-radius: 8px; display: grid; place-items: center; font-weight: 700;
        }
        .brand h1 { font-size: 1.05rem; color: var(--navy); }
        .brand span { font-size: 0.78rem; color: var(--muted); display: block; }
        .pill {
            background: var(--tint); color: var(--blue); border: 1px solid #dbeafe;
            padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600;
        }
        main { max-width: 1100px; margin: 1.75rem auto; padding: 0 1.25rem; display: grid; gap: 1.25rem; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1rem; }
        .card { background: var(--white); border: 1px solid var(--line); border-radius: 10px; padding: 1.2rem; }
        .label { font-size: 0.8rem; color: var(--muted); margin-bottom: 0.3rem; }
        .value { font-size: 1.6rem; font-weight: 700; color: var(--navy); }
        .sub { font-size: 0.76rem; color: var(--muted); margin-top: 0.2rem; }
        .grid { display: grid; grid-template-columns: 1.6fr 1fr; gap: 1.25rem; }
        @media (max-width: 820px) { .grid { grid-template-columns: 1fr; } }
        .head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.9rem; }
        .head h2 { font-size: 0.98rem; }
        .head span { font-size: 0.78rem; color: var(--blue); font-weight: 500; }
        .map-box {
            background: var(--tint); border: 1px dashed #93c5fd; border-radius: 8px;
            height: 210px; display: grid; place-items: center; text-align: center;
            padding: 1rem; margin-bottom: 1.1rem;
        }
        .map-box p { color: var(--navy); font-weight: 600; font-size: 0.92rem; }
        .map-box small { color: var(--muted); font-size: 0.8rem; }
        table { width: 100%; border-collapse: collapse; font-size: 0.86rem; }
        th { text-align: left; color: var(--muted); padding: 0.6rem 0.4rem; border-bottom: 1px solid var(--line); }
        td { padding: 0.65rem 0.4rem; border-bottom: 1px solid var(--line); }
        tr:last-child td { border-bottom: none; }
        .tag {
            background: var(--tint); color: var(--blue); padding: 0.18rem 0.55rem;
            border-radius: 6px; font-size: 0.76rem; font-weight: 600;
        }
        .field { margin-bottom: 0.85rem; }
        label { display: block; font-size: 0.8rem; font-weight: 500; margin-bottom: 0.3rem; }
        select, textarea {
            width: 100%; padding: 0.55rem 0.7rem; border: 1px solid var(--line);
            border-radius: 8px; font: inherit; font-size: 0.86rem; background: var(--white);
        }
        select:focus, textarea:focus { outline: none; border-color: var(--blue); }
        button {
            width: 100%; background: var(--blue); color: var(--white); border: none;
            border-radius: 8px; padding: 0.65rem; font-weight: 600; cursor: pointer;
        }
        button:hover { background: var(--navy); }
        .reports { margin-top: 1.1rem; padding-top: 0.9rem; border-top: 1px solid var(--line); }
        .item { padding: 0.55rem 0; border-bottom: 1px solid var(--line); font-size: 0.84rem; }
        .item:last-child { border-bottom: none; }
        .item strong { color: var(--navy); }
        .meta { display: block; font-size: 0.75rem; color: var(--muted); margin-top: 0.1rem; }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo">A</div>
            <div>
                <h1>AGOS Command Overview</h1>
                <span>CDRRMO Flood Detection &amp; AR Monitoring</span>
            </div>
        </div>
        <div class="pill">System Active • Live Sync</div>
    </header>

    <main>
        <section class="stats">
            <div class="card">
                <div class="label">Monitored Barangays</div>
                <div class="value">12</div>
                <div class="sub">All sensors &amp; feeds online</div>
            </div>
            <div class="card">
                <div class="label">Highest Flood Reading</div>
                <div class="value">0.45 m</div>
                <div class="sub">Ankle-to-knee (Alert Level 1)</div>
            </div>
            <div class="card">
                <div class="label">Verified Citizen Reports</div>
                <div class="value">4</div>
                <div class="sub">Submitted via mobile AR today</div>
            </div>
            <div class="card">
                <div class="label">Passable Main Routes</div>
                <div class="value">9 / 10</div>
                <div class="sub">1 minor detour advisory active</div>
            </div>
        </section>

        <section class="grid">
            <div class="card">
                <div class="head">
                    <h2>GIS Flood Hazard &amp; AR Marker View</h2>
                    <span>Map Container Ready</span>
                </div>
                <div class="map-box">
                    <div>
                        <p>Interactive Hazard Map &amp; AR Flood Depth Layer</p>
                        <small>Placeholder for GIS map integration and live water-level markers</small>
                    </div>
                </div>
                <div class="head">
                    <h2>Barangay Water Level Status</h2>
                    <span>Updated just now</span>
                </div>
                <table>
                    <thead>
                        <tr><th>Barangay</th><th>Est. Depth</th><th>Status</th><th>Route Access</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Poblacion</td><td>0.45 m</td><td><span class="tag">Advisory</span></td><td>Light Vehicles Caution</td></tr>
                        <tr><td>San Jose</td><td>0.18 m</td><td><span class="tag">Normal</span></td><td>Passable</td></tr>
                        <tr><td>Bagong Nayon</td><td>0.10 m</td><td><span class="tag">Normal</span></td><td>Passable</td></tr>
                        <tr><td>Subic</td><td>0.30 m</td><td><span class="tag">Monitoring</span></td><td>Passable</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="head">
                    <h2>Issue Verified Alert</h2>
                    <span>CDRRMO Broadcast</span>
                </div>
                <form onsubmit="event.preventDefault();">
                    <div class="field">
                        <label for="barangay">Target Area / Barangay</label>
                        <select id="barangay">
                            <option>All Monitored Barangays</option>
                            <option>Poblacion</option>
                            <option>San Jose</option>
                            <option>Bagong Nayon</option>
                            <option>Subic</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="level">Alert Level</label>
                        <select id="level">
                            <option>Level 1 — Rain &amp; Water Monitoring</option>
                            <option>Level 2 — Prepare / Route Advisory</option>
                            <option>Level 3 — Evacuation / Impassable</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="message">Advisory Message</label>
                        <textarea id="message" rows="3" placeholder="Enter short public safety advisory..."></textarea>
                    </div>
                    <button type="submit">Publish Alert</button>
                </form>

                <div class="reports">
                    <div class="head">
                        <h2>Recent AR Field Reports</h2>
                        <span>Queue</span>
                    </div>
                    <div class="item">
                        <strong>Poblacion — Main Intersection</strong>: Measured ~0.45 m via AR overlay.
                        <span class="meta">Verified • 8 mins ago</span>
                    </div>
                    <div class="item">
                        <strong>Subic — Riverside Road</strong>: Water rising slowly near drainage inlet.
                        <span class="meta">Pending Review • 19 mins ago</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>