@extends('layouts.app')

@section('title', 'Browse Job Categories')

@push('styles')
<style>
/* ── Category page hero ──────────────────────────── */
.cat-hero {
    position: relative;
    padding: 7rem 0 5rem;
    overflow: hidden;
    background: var(--navy);
    color: white;
}
.cat-hero-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}
.cat-hero-orb-1 { width: 500px; height: 500px; top: -150px; left: -100px;  background: radial-gradient(circle, rgba(255,107,107,0.25) 0%, transparent 70%); }
.cat-hero-orb-2 { width: 400px; height: 400px; bottom: -120px; right: -80px; background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, transparent 70%); }
.cat-hero-orb-3 { width: 250px; height: 250px; top: 40%; left: 55%;        background: radial-gradient(circle, rgba(255,200,100,0.15) 0%, transparent 70%); }
.cat-hero-content { position: relative; z-index: 2; text-align: center; }
.cat-hero-eyebrow {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 9999px; padding: 0.4rem 1.2rem; font-size: 0.8rem;
    letter-spacing: 0.1em; text-transform: uppercase; color: #fca5a5;
    margin-bottom: 1.5rem; backdrop-filter: blur(6px); font-weight: 600;
}
.cat-hero h1 {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    background: linear-gradient(135deg, #fff 40%, #fca5a5 100%);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent; color: transparent;
    margin-bottom: 1.2rem;
}
.cat-hero p { color: #94a3b8; font-size: 1.15rem; max-width: 560px; margin: 0 auto 2rem; }

/* live count pill */
.cat-count-pill {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12);
    border-radius: 9999px; padding: 0.45rem 1.1rem; font-size: 0.9rem; color: #e2e8f0;
}
.cat-count-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #4ade80;
    box-shadow: 0 0 0 0 rgba(74,222,128,0.6);
    animation: pulse-dot 2s infinite;
}
@keyframes pulse-dot {
    0%   { box-shadow: 0 0 0 0 rgba(74,222,128,0.6); }
    70%  { box-shadow: 0 0 0 8px rgba(74,222,128,0); }
    100% { box-shadow: 0 0 0 0 rgba(74,222,128,0); }
}

/* ── Category grid ───────────────────────────────── */
.cat-section { padding: 5rem 0 6rem; background: var(--bg-main); }
.cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 1.75rem;
}

/* ── Individual card ─────────────────────────────── */
.cat-card {
    position: relative;
    border-radius: 1.5rem;
    padding: 2rem 1.75rem 1.75rem;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.055);
    box-shadow: 0 4px 16px rgba(10,25,47,0.06);
    display: flex; flex-direction: column; gap: 0; overflow: hidden;
    text-decoration: none; color: inherit;
    transition: transform 0.35s cubic-bezier(0.25,0.8,0.25,1),
                box-shadow 0.35s cubic-bezier(0.25,0.8,0.25,1),
                border-color 0.35s;
    cursor: pointer;
    /* stagger via inline style */
    animation: cardIn 0.6s both;
}
@keyframes cardIn {
    from { opacity: 0; transform: translateY(30px) scale(0.96); }
    to   { opacity: 1; transform: translateY(0)   scale(1);    }
}

/* top accent stripe */
.cat-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 4px;
    background: var(--cat-accent, var(--primary));
    border-radius: 1.5rem 1.5rem 0 0;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s cubic-bezier(0.25,0.8,0.25,1);
}
.cat-card:hover::before { transform: scaleX(1); }

/* shimmer on hover */
.cat-card::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.45) 50%, transparent 70%);
    transform: translateX(-100%);
    transition: transform 0.55s ease;
    pointer-events: none;
}
.cat-card:hover::after { transform: translateX(100%); }

.cat-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 44px rgba(10,25,47,0.13);
    border-color: rgba(0,0,0,0.09);
}

/* bg blob that tints on hover */
.cat-card-blob {
    position: absolute;
    width: 180px; height: 180px;
    border-radius: 50%;
    top: -60px; right: -50px;
    background: var(--cat-accent, var(--primary));
    opacity: 0.06;
    transition: opacity 0.4s, transform 0.4s;
    pointer-events: none;
}
.cat-card:hover .cat-card-blob { opacity: 0.13; transform: scale(1.2); }

/* icon circle */
.cat-icon-ring {
    position: relative;
    width: 70px; height: 70px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.65rem;
    background: var(--cat-icon-bg, rgba(99,102,241,0.1));
    color: var(--cat-icon-color, #6366f1);
    margin-bottom: 1.25rem;
    flex-shrink: 0;
    transition: transform 0.35s, box-shadow 0.35s;
}
.cat-card:hover .cat-icon-ring {
    transform: rotate(-8deg) scale(1.12);
    box-shadow: 0 8px 24px var(--cat-shadow, rgba(99,102,241,0.3));
}

/* spinning ring decoration */
.cat-icon-ring::before {
    content: '';
    position: absolute; inset: -5px;
    border-radius: 50%;
    border: 2px dashed var(--cat-icon-color, #6366f1);
    opacity: 0;
    transition: opacity 0.35s;
    animation: spin-ring 8s linear infinite;
}
.cat-card:hover .cat-icon-ring::before { opacity: 0.4; }
@keyframes spin-ring { to { transform: rotate(360deg); } }

/* text */
.cat-card h3 {
    font-size: 1.15rem; font-weight: 700;
    color: var(--navy); margin-bottom: 0.4rem;
    transition: color 0.3s;
}
.cat-card:hover h3 { color: var(--cat-icon-color, #6366f1); }
.cat-card p {
    font-size: 0.875rem; color: var(--text-muted);
    line-height: 1.55; margin-bottom: 1.25rem; flex: 1;
}

/* footer row */
.cat-card-footer {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: auto; padding-top: 1rem;
    border-top: 1px solid #f1f5f9;
}
.cat-jobs-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: var(--cat-badge-bg, rgba(99,102,241,0.1));
    color: var(--cat-icon-color, #6366f1);
    border-radius: 9999px; padding: 0.3rem 0.85rem;
    font-size: 0.8rem; font-weight: 700;
}
.cat-arrow {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: var(--cat-badge-bg, rgba(99,102,241,0.1));
    color: var(--cat-icon-color, #6366f1);
    font-size: 0.75rem;
    transition: transform 0.3s, background 0.3s;
}
.cat-card:hover .cat-arrow {
    transform: translateX(4px);
    background: var(--cat-icon-color, #6366f1);
    color: #fff;
}

/* active selected card */
.cat-card.active {
    border-color: var(--cat-accent, var(--primary));
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--cat-accent, var(--primary)) 20%, transparent),
                0 20px 44px rgba(10,25,47,0.13);
}
.cat-card.active::before { transform: scaleX(1); }

/* ── Jobs Drawer ─────────────────────────────────── */
#cat-jobs-drawer {
    display: none;
    background: var(--bg-main);
    border-top: 2px solid transparent;
    border-image: linear-gradient(90deg, var(--primary), #6366f1, #14b8a6) 1;
    padding: 3rem 0 4rem;
    animation: drawerIn 0.4s cubic-bezier(0.25,0.8,0.25,1) both;
}
@keyframes drawerIn {
    from { opacity: 0; transform: translateY(-16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* drawer header */
.drawer-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
}
.drawer-title {
    font-size: 1.6rem; font-weight: 800; color: var(--navy);
    display: flex; align-items: center; gap: 0.6rem;
}
.drawer-title span.accent { color: var(--primary); }
.drawer-meta { font-size: 0.9rem; color: var(--text-muted); margin-top: 0.2rem; }
.drawer-actions { display: flex; gap: 0.75rem; align-items: center; }
.drawer-close-btn {
    width: 36px; height: 36px; border-radius: 50%;
    background: #f1f5f9; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); font-size: 1rem;
    transition: background 0.2s, color 0.2s;
}
.drawer-close-btn:hover { background: #e2e8f0; color: var(--navy); }

/* job cards inside drawer */
.drawer-jobs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.25rem;
}
.djob-card {
    background: #fff;
    border-radius: 1.25rem;
    padding: 1.5rem;
    border: 1px solid rgba(0,0,0,0.055);
    box-shadow: 0 4px 14px rgba(10,25,47,0.05);
    display: flex; flex-direction: column; gap: 0.75rem;
    text-decoration: none; color: inherit;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
    animation: jobCardIn 0.45s both;
}
@keyframes jobCardIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.djob-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 32px rgba(10,25,47,0.1);
    border-color: rgba(0,0,0,0.09);
}

/* drawer job card internals */
.djob-header { display: flex; align-items: flex-start; gap: 0.85rem; }
.djob-logo {
    width: 44px; height: 44px; border-radius: 0.6rem;
    object-fit: cover; flex-shrink: 0;
    border: 1px solid #f1f5f9;
}
.djob-meta { flex: 1; min-width: 0; }
.djob-company { font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; }
.djob-location { font-size: 0.78rem; color: #94a3b8; display: flex; align-items: center; gap: 0.3rem; margin-top: 0.15rem; }
.djob-title {
    font-size: 1rem; font-weight: 700; color: var(--navy);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.djob-badges { display: flex; gap: 0.4rem; flex-wrap: wrap; }
.djob-badge {
    border-radius: 9999px; padding: 0.2rem 0.65rem;
    font-size: 0.72rem; font-weight: 600;
}
.djob-badge.type  { background: rgba(99,102,241,0.1);  color: #6366f1; }
.djob-badge.exp   { background: rgba(10,25,47,0.07);   color: var(--navy); }
.djob-salary { font-size: 0.9rem; font-weight: 700; color: var(--navy); }
.djob-salary span { font-weight: 400; color: var(--text-muted); font-size: 0.8rem; }
.djob-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 0.75rem; border-top: 1px solid #f1f5f9;
    margin-top: auto;
}
.djob-posted { font-size: 0.78rem; color: var(--text-muted); }
.djob-view-btn {
    padding: 0.35rem 0.9rem; border-radius: 9999px;
    background: var(--navy); color: #fff;
    font-size: 0.78rem; font-weight: 600;
    border: none; cursor: pointer; transition: background 0.2s;
}
.djob-view-btn:hover { background: var(--navy-light); }

/* skeleton loader */
.djob-skeleton {
    background: #fff; border-radius: 1.25rem;
    padding: 1.5rem; border: 1px solid rgba(0,0,0,0.055);
    display: flex; flex-direction: column; gap: 0.75rem;
}
.skel { background: linear-gradient(90deg,#f1f5f9 25%,#e2e8f0 50%,#f1f5f9 75%); background-size: 200% 100%; border-radius: 0.5rem; animation: skel-shimmer 1.4s infinite; }
@keyframes skel-shimmer { to { background-position: -200% 0; } }
.skel.h-10 { height: 10px; }
.skel.h-14 { height: 14px; }
.skel.h-18 { height: 18px; }
.skel.w-50 { width: 50%; }
.skel.w-70 { width: 70%; }
.skel.circle { width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0; }
.skel-row { display: flex; gap: 0.85rem; align-items: center; }

/* browse-all CTA strip */
#drawer-browse-all {
    display: none;
    margin-top: 2rem; text-align: center;
}

/* ── Responsive ──────────────────────────────────── */
@media (max-width: 640px) {
    .cat-grid { grid-template-columns: 1fr 1fr; gap: 1rem; }
    .cat-card { padding: 1.5rem 1.2rem 1.25rem; }
    .drawer-jobs-grid { grid-template-columns: 1fr; }
}
@media (max-width: 400px) {
    .cat-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@php
/* Per-category colour themes — cycles if there are more categories */
$palettes = [
    ['accent'=>'#6366f1','iconBg'=>'rgba(99,102,241,0.1)','iconColor'=>'#6366f1','shadow'=>'rgba(99,102,241,0.3)','badge'=>'rgba(99,102,241,0.1)'],
    ['accent'=>'#f43f5e','iconBg'=>'rgba(244,63,94,0.1)',  'iconColor'=>'#f43f5e','shadow'=>'rgba(244,63,94,0.3)',  'badge'=>'rgba(244,63,94,0.1)'],
    ['accent'=>'#0ea5e9','iconBg'=>'rgba(14,165,233,0.1)', 'iconColor'=>'#0ea5e9','shadow'=>'rgba(14,165,233,0.3)', 'badge'=>'rgba(14,165,233,0.1)'],
    ['accent'=>'#10b981','iconBg'=>'rgba(16,185,129,0.1)', 'iconColor'=>'#10b981','shadow'=>'rgba(16,185,129,0.3)', 'badge'=>'rgba(16,185,129,0.1)'],
    ['accent'=>'#f59e0b','iconBg'=>'rgba(245,158,11,0.1)', 'iconColor'=>'#f59e0b','shadow'=>'rgba(245,158,11,0.3)', 'badge'=>'rgba(245,158,11,0.1)'],
    ['accent'=>'#8b5cf6','iconBg'=>'rgba(139,92,246,0.1)', 'iconColor'=>'#8b5cf6','shadow'=>'rgba(139,92,246,0.3)', 'badge'=>'rgba(139,92,246,0.1)'],
    ['accent'=>'#ec4899','iconBg'=>'rgba(236,72,153,0.1)', 'iconColor'=>'#ec4899','shadow'=>'rgba(236,72,153,0.3)', 'badge'=>'rgba(236,72,153,0.1)'],
    ['accent'=>'#14b8a6','iconBg'=>'rgba(20,184,166,0.1)', 'iconColor'=>'#14b8a6','shadow'=>'rgba(20,184,166,0.3)', 'badge'=>'rgba(20,184,166,0.1)'],
];
$total = $categories->sum('jobs_count');
@endphp

@section('content')

{{-- ── HERO ─────────────────────────────────────────── --}}
<section class="cat-hero">
    <div class="cat-hero-orb cat-hero-orb-1"></div>
    <div class="cat-hero-orb cat-hero-orb-2"></div>
    <div class="cat-hero-orb cat-hero-orb-3"></div>

    <div class="container cat-hero-content">
        <div class="cat-hero-eyebrow">
            <i class="fa-solid fa-layer-group"></i>
            All Categories
        </div>
        <h1>Explore by Category</h1>
        <p>Find roles tailored to your specific skillset and passion — browse every field in one place.</p>
        <div class="cat-count-pill">
            <span class="cat-count-dot"></span>
            <strong>{{ $total }}</strong>&nbsp;live jobs across&nbsp;<strong>{{ $categories->count() }}</strong>&nbsp;categories
        </div>
    </div>
</section>

{{-- ── GRID ─────────────────────────────────────────── --}}
<section class="cat-section">
    <div class="container">
        <div class="cat-grid">
            @foreach($categories as $index => $category)
                @php $p = $palettes[$index % count($palettes)]; @endphp
                <button type="button"
                   class="cat-card"
                   data-slug="{{ $category->slug }}"
                   data-name="{{ $category->name }}"
                   data-color="{{ $p['accent'] }}"
                   style="
                       --cat-accent:      {{ $p['accent'] }};
                       --cat-icon-bg:     {{ $p['iconBg'] }};
                       --cat-icon-color:  {{ $p['iconColor'] }};
                       --cat-shadow:      {{ $p['shadow'] }};
                       --cat-badge-bg:    {{ $p['badge'] }};
                       animation-delay:   {{ $index * 0.07 }}s;
                       text-align: left; width: 100%; font-family: inherit;
                   ">

                    {{-- tint blob --}}
                    <div class="cat-card-blob"></div>

                    {{-- icon --}}
                    <div class="cat-icon-ring">
                        <i class="{{ $category->icon ?? 'fa-solid fa-briefcase' }}"></i>
                    </div>

                    {{-- text --}}
                    <h3>{{ $category->name }}</h3>
                    <p>{{ Str::limit($category->description ?? 'Discover exciting opportunities in this field.', 70) }}</p>

                    {{-- footer --}}
                    <div class="cat-card-footer">
                        <span class="cat-jobs-badge">
                            <i class="fa-solid fa-briefcase" style="font-size:0.7rem;"></i>
                            {{ $category->jobs_count }} Jobs
                        </span>
                        <span class="cat-arrow">
                            <i class="fa-solid fa-chevron-down cat-toggle-icon" style="font-size:0.72rem;"></i>
                        </span>
                    </div>
                </button>
            @endforeach
        </div><!-- /.cat-grid -->
    </div><!-- /.container -->
</section><!-- /.cat-section -->

{{-- ── INLINE JOBS DRAWER ──────────────────────────── --}}
<section id="cat-jobs-drawer">
    <div class="container">
        <div class="drawer-header">
            <div>
                <div class="drawer-title">
                    <i class="fa-solid fa-briefcase" id="drawer-icon" style="font-size:1.3rem;"></i>
                    Jobs in <span class="accent" id="drawer-cat-name">…</span>
                </div>
                <div class="drawer-meta" id="drawer-meta">Loading…</div>
            </div>
            <div class="drawer-actions">
                <a id="drawer-browse-link" href="#" class="btn btn-primary sm" style="display:none;">
                    Browse All <i class="fa-solid fa-arrow-right" style="margin-left:0.4rem;"></i>
                </a>
                <button class="drawer-close-btn" id="drawer-close-btn" title="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <div class="drawer-jobs-grid" id="drawer-jobs-grid"></div>

        <div id="drawer-browse-all">
            <a id="drawer-browse-all-link" href="#" class="btn btn-secondary">
                Browse All Jobs in this Category <i class="fa-solid fa-arrow-right" style="margin-left:0.5rem;"></i>
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function() {
    const drawer      = document.getElementById('cat-jobs-drawer');
    const grid        = document.getElementById('drawer-jobs-grid');
    const catName     = document.getElementById('drawer-cat-name');
    const meta        = document.getElementById('drawer-meta');
    const closeBtn    = document.getElementById('drawer-close-btn');
    const browseLink  = document.getElementById('drawer-browse-link');
    const browseAll   = document.getElementById('drawer-browse-all');
    const browseAllLk = document.getElementById('drawer-browse-all-link');

    let activeSlug = null;

    /* ── helpers ─────────────────────────────────── */
    function fmt(n) {
        return new Intl.NumberFormat('en-IN').format(n);
    }

    function skeletonHTML() {
        let out = '';
        for (let i = 0; i < 4; i++) {
            out += `
            <div class="djob-skeleton">
                <div class="skel-row">
                    <div class="skel circle"></div>
                    <div style="flex:1;display:flex;flex-direction:column;gap:0.4rem;">
                        <div class="skel h-14 w-70"></div>
                        <div class="skel h-10 w-50"></div>
                    </div>
                </div>
                <div class="skel h-18 w-70"></div>
                <div class="skel h-10 w-50"></div>
                <div class="skel h-14"></div>
            </div>`;
        }
        return out;
    }

    function jobCardHTML(job) {
        return `
        <a href="${job.url}" class="djob-card">
            <div class="djob-header">
                <img src="${job.company.logo}" alt="${job.company.name}" class="djob-logo">
                <div class="djob-meta">
                    <span class="djob-company">${job.company.name}</span>
                    <span class="djob-location"><i class="fa-solid fa-location-dot" style="font-size:0.7rem;"></i> ${job.location}</span>
                </div>
            </div>
            <div class="djob-title">${job.title}</div>
            <div class="djob-badges">
                <span class="djob-badge type">${job.job_type}</span>
                <span class="djob-badge exp">${job.experience}</span>
            </div>
            <div class="djob-salary">₹${fmt(job.salary_min)} – ₹${fmt(job.salary_max)} <span>/ year</span></div>
            <div class="djob-footer">
                <span class="djob-posted">${job.posted_at}</span>
                <span class="djob-view-btn">View Job</span>
            </div>
        </a>`;
    }

    /* ── open / close ────────────────────────────── */
    function openDrawer(slug, name, browseUrl) {
        catName.textContent = name;
        meta.textContent = 'Loading jobs…';
        browseLink.style.display = 'none';
        browseAll.style.display = 'none';
        grid.innerHTML = skeletonHTML();

        // Show drawer with animation re-trigger
        drawer.style.display = 'block';
        drawer.style.animation = 'none';
        drawer.offsetHeight; // reflow
        drawer.style.animation = '';

        drawer.scrollIntoView({ behavior: 'smooth', block: 'start' });

        fetch(`/categories/${slug}/jobs`)
            .then(r => r.json())
            .then(data => {
                catName.textContent = data.category;
                meta.textContent = `${data.total} job${data.total !== 1 ? 's' : ''} found`;

                browseLink.href = data.browse_url;
                browseLink.style.display = 'inline-flex';
                browseAllLk.href = data.browse_url;

                if (data.jobs.length === 0) {
                    grid.innerHTML = `
                        <div style="grid-column:1/-1;text-align:center;padding:3rem 1rem;color:var(--text-muted);">
                            <i class="fa-solid fa-magnifying-glass" style="font-size:2.5rem;margin-bottom:1rem;display:block;"></i>
                            No jobs listed in this category yet.
                        </div>`;
                    return;
                }

                grid.innerHTML = data.jobs.map((job, i) => {
                    const card = jobCardHTML(job);
                    // inject stagger delay
                    return card.replace('class="djob-card"',
                        `class="djob-card" style="animation-delay:${i * 0.06}s;"`);
                }).join('');

                if (data.has_more) {
                    browseAll.style.display = 'block';
                }
            })
            .catch(() => {
                grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:2rem;color:#ef4444;">Failed to load jobs. Please try again.</div>`;
            });
    }

    function closeDrawer() {
        drawer.style.display = 'none';
        activeSlug = null;
        document.querySelectorAll('.cat-card').forEach(c => {
            c.classList.remove('active');
            const ico = c.querySelector('.cat-toggle-icon');
            if (ico) { ico.style.transform = ''; }
        });
    }

    /* ── card click ──────────────────────────────── */
    document.querySelectorAll('.cat-card').forEach(card => {
        card.addEventListener('click', function() {
            const slug = this.dataset.slug;
            const name = this.dataset.name;

            if (activeSlug === slug) {
                closeDrawer();
                return;
            }

            // deactivate others
            document.querySelectorAll('.cat-card').forEach(c => {
                c.classList.remove('active');
                const ico = c.querySelector('.cat-toggle-icon');
                if (ico) { ico.style.transform = ''; }
            });

            // activate this card
            this.classList.add('active');
            const ico = this.querySelector('.cat-toggle-icon');
            if (ico) { ico.style.transform = 'rotate(180deg)'; }

            activeSlug = slug;
            openDrawer(slug, name);
        });
    });

    /* ── close button ────────────────────────────── */
    closeBtn.addEventListener('click', closeDrawer);

    /* ── Escape key ──────────────────────────────── */
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && drawer.style.display !== 'none') closeDrawer();
    });
})();
</script>
@endpush
