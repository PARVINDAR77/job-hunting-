@extends('layouts.app')

@section('title', 'Find Jobs Near You – Explore by Location')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════
   LOCATIONS PAGE — 3D Edition
═══════════════════════════════════════════════════ */

/* ── Custom props ─────────────────────────────────── */
:root {
    --loc-ease: cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* ══ HERO ═════════════════════════════════════════ */
.loc-hero {
    position: relative;
    min-height: 520px;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    background: radial-gradient(ellipse at 60% 40%, #1a0533 0%, #0a192f 60%, #040d1a 100%);
    color: white;
}

/* floating particles canvas */
#loc-particles { position: absolute; inset: 0; pointer-events: none; z-index: 0; }

/* 3-D rotating globe ring */
.globe-ring-wrapper {
    position: absolute;
    width: 560px; height: 560px;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none; z-index: 0;
}
.globe-ring {
    position: absolute; inset: 0;
    border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,0.06);
}
.globe-ring:nth-child(1) { transform: rotateX(75deg);          animation: ring-spin 18s linear infinite; }
.globe-ring:nth-child(2) { transform: rotateX(75deg) rotateZ(60deg);  animation: ring-spin 24s linear infinite reverse; }
.globe-ring:nth-child(3) { transform: rotateX(75deg) rotateZ(120deg); animation: ring-spin 30s linear infinite; }
.globe-ring:nth-child(4) { transform: rotateX(75deg) rotateZ(180deg); animation: ring-spin 20s linear infinite reverse; }
@keyframes ring-spin { to { transform: rotateX(75deg) rotateZ(360deg); } }
.globe-ring:nth-child(2) { animation-name: ring-spin-2; }
.globe-ring:nth-child(3) { animation-name: ring-spin-3; }
.globe-ring:nth-child(4) { animation-name: ring-spin-4; }
@keyframes ring-spin-2  { from { transform: rotateX(75deg) rotateZ(60deg);  } to { transform: rotateX(75deg) rotateZ(420deg); } }
@keyframes ring-spin-3  { from { transform: rotateX(75deg) rotateZ(120deg); } to { transform: rotateX(75deg) rotateZ(480deg); } }
@keyframes ring-spin-4  { from { transform: rotateX(75deg) rotateZ(180deg); } to { transform: rotateX(75deg) rotateZ(540deg); } }

/* glowing orbs */
.loc-orb {
    position: absolute; border-radius: 50%;
    filter: blur(90px); pointer-events: none; z-index: 0;
}
.loc-orb-1 { width: 500px; height: 500px; top: -160px; left: -100px; background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 70%); }
.loc-orb-2 { width: 400px; height: 400px; bottom: -130px; right: -80px; background: radial-gradient(circle, rgba(236,72,153,0.2) 0%, transparent 70%); }
.loc-orb-3 { width: 250px; height: 250px; top: 30%; left: 45%; background: radial-gradient(circle, rgba(79,172,254,0.18) 0%, transparent 70%); animation: orb-float 7s ease-in-out infinite alternate; }
@keyframes orb-float { to { transform: translate(30px, -20px); } }

/* hero content */
.loc-hero-content {
    position: relative; z-index: 2;
    text-align: center; padding: 7rem 1.5rem 5rem;
    max-width: 720px; margin: 0 auto;
}
.loc-eyebrow {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.13);
    border-radius: 9999px; padding: 0.4rem 1.2rem;
    font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase;
    color: #a5b4fc; margin-bottom: 1.5rem;
    backdrop-filter: blur(6px); font-weight: 600;
    animation: fadeUp 0.7s 0.1s both;
}
.loc-hero h1 {
    font-size: clamp(2.6rem, 5.5vw, 4.2rem);
    font-weight: 900; line-height: 1.1;
    background: linear-gradient(135deg, #ffffff 30%, #a5b4fc 60%, #f9a8d4 100%);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent; color: transparent;
    margin-bottom: 1.2rem;
    animation: fadeUp 0.7s 0.2s both;
}
.loc-hero p {
    color: #94a3b8; font-size: 1.15rem; max-width: 520px; margin: 0 auto 2rem;
    animation: fadeUp 0.7s 0.3s both;
}

/* live stats strip */
.loc-stats-strip {
    display: inline-flex; gap: 2rem; align-items: center;
    background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 9999px; padding: 0.75rem 2rem;
    animation: fadeUp 0.7s 0.4s both; flex-wrap: wrap; justify-content: center;
}
.loc-stat { text-align: center; }
.loc-stat-num { font-size: 1.4rem; font-weight: 800; color: #fff; display: block; }
.loc-stat-lbl { font-size: 0.72rem; color: #94a3b8; letter-spacing: 0.06em; text-transform: uppercase; }
.loc-stat-divider { width: 1px; height: 36px; background: rgba(255,255,255,0.12); }

/* ── scroll indicator */
.scroll-indicator {
    position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
    display: flex; flex-direction: column; align-items: center; gap: 0.5rem;
    color: rgba(255,255,255,0.35); font-size: 0.72rem; letter-spacing: 0.08em;
    text-transform: uppercase; z-index: 2; animation: pulse-fade 2s ease-in-out infinite;
}
.scroll-indicator i { font-size: 1rem; }
@keyframes pulse-fade { 0%,100%{opacity:0.35} 50%{opacity:0.8} }

/* ══ SECTION WRAPPER ══════════════════════════════ */
.loc-section { padding: 5.5rem 0 7rem; background: var(--bg-main); }

/* section heading */
.loc-section-head { text-align: center; margin-bottom: 3.5rem; }
.loc-section-head h2 { font-size: 2.2rem; font-weight: 800; color: var(--navy); margin-bottom: 0.6rem; }
.loc-section-head p  { color: var(--text-muted); max-width: 480px; margin: 0 auto; }

/* ══ GRID ════════════════════════════════════════ */
.loc-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.75rem;
    perspective: 1200px;
}

/* ══ LOCATION CARD — 3D tilt ═════════════════════ */
.loc-card {
    position: relative;
    border-radius: 1.5rem;
    overflow: hidden;
    min-height: 260px;
    display: flex; flex-direction: column;
    text-decoration: none; color: inherit;
    cursor: pointer;

    transform-style: preserve-3d;
    transform: perspective(800px) rotateX(0deg) rotateY(0deg) scale(1);
    transition: transform 0.08s linear, box-shadow 0.3s var(--loc-ease);
    box-shadow: 0 8px 24px rgba(10,25,47,0.12);

    animation: cardReveal 0.7s both;
}
@keyframes cardReveal {
    from { opacity: 0; transform: perspective(800px) translateY(40px) rotateX(8deg); }
    to   { opacity: 1; transform: perspective(800px) translateY(0) rotateX(0); }
}

/* gradient background layer */
.loc-card-bg {
    position: absolute; inset: 0;
    background: var(--card-gradient);
    transition: transform 0.5s var(--loc-ease);
    z-index: 0;
}
.loc-card:hover .loc-card-bg { transform: scale(1.07); }

/* noise texture overlay */
.loc-card-noise {
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    z-index: 1; pointer-events: none;
}

/* shimmer sweep */
.loc-card::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(120deg, transparent 25%, rgba(255,255,255,0.18) 50%, transparent 75%);
    transform: translateX(-120%);
    transition: transform 0.65s ease;
    z-index: 3; pointer-events: none;
}
.loc-card:hover::after { transform: translateX(120%); }

/* glow ring on hover */
.loc-card::before {
    content: '';
    position: absolute; inset: -3px;
    border-radius: calc(1.5rem + 3px);
    background: var(--card-gradient);
    opacity: 0;
    filter: blur(18px);
    transition: opacity 0.4s;
    z-index: -1;
}
.loc-card:hover::before { opacity: 0.6; }

/* card content */
.loc-card-content {
    position: relative; z-index: 4;
    padding: 2.25rem 2rem 2rem;
    display: flex; flex-direction: column; height: 100%;
    color: white;
}

/* big decorative icon */
.loc-deco-icon {
    position: absolute; bottom: -18px; right: -18px;
    font-size: 9rem; color: rgba(255,255,255,0.1);
    z-index: 2; pointer-events: none;
    transition: transform 0.5s var(--loc-ease), opacity 0.5s;
    transform: rotate(-15deg) scale(1);
}
.loc-card:hover .loc-deco-icon { transform: rotate(-5deg) scale(1.15); opacity: 0.18; }

/* small icon badge */
.loc-icon-badge {
    width: 48px; height: 48px; border-radius: 0.9rem;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(8px);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; color: white;
    margin-bottom: 1.25rem;
    transition: transform 0.35s var(--loc-ease), background 0.3s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.loc-card:hover .loc-icon-badge { transform: rotate(-8deg) scale(1.1); background: rgba(255,255,255,0.28); }

/* text */
.loc-city { font-size: 1.9rem; font-weight: 800; color: white; margin-bottom: 0.15rem; line-height: 1.1; }
.loc-state { font-size: 0.88rem; color: rgba(255,255,255,0.75); margin-bottom: 0.5rem; }
.loc-tagline { font-size: 0.82rem; color: rgba(255,255,255,0.65); font-style: italic; margin-bottom: auto; }

/* bottom row */
.loc-card-bottom {
    display: flex; justify-content: space-between; align-items: center;
    margin-top: 1.75rem; padding-top: 1rem;
    border-top: 1px solid rgba(255,255,255,0.18);
}
.loc-count-pill {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(6px);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 9999px; padding: 0.35rem 1rem;
    font-size: 0.82rem; font-weight: 700; color: white;
    display: flex; align-items: center; gap: 0.4rem;
}
.loc-count-num {
    font-size: 1.05rem; font-weight: 800;
}
.loc-arrow-btn {
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(255,255,255,0.95);
    display: flex; align-items: center; justify-content: center;
    color: #111; font-size: 0.85rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    transition: transform 0.3s var(--loc-ease), box-shadow 0.3s;
}
.loc-card:hover .loc-arrow-btn {
    transform: translateX(4px) scale(1.1);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

/* ── highlighted "Remote" card spans full width on last row */
.loc-card.remote { grid-column: span 2; }

/* ══ FADE-UP KEYFRAME ════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ══ INFO STRIP below grid ════════════════════════ */
.loc-info-strip {
    display: flex; align-items: center; justify-content: center; gap: 3rem;
    margin-top: 4rem; padding: 2rem 3rem;
    background: #fff; border-radius: 1.5rem;
    box-shadow: 0 4px 24px rgba(10,25,47,0.06);
    flex-wrap: wrap;
}
.loc-info-item { display: flex; align-items: center; gap: 1rem; }
.loc-info-icon {
    width: 48px; height: 48px; border-radius: 0.75rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.1rem;
}
.loc-info-text strong { display: block; font-size: 1rem; font-weight: 700; color: var(--navy); }
.loc-info-text span { font-size: 0.82rem; color: var(--text-muted); }

/* ══ AURORA CTA SECTION ═════════════════════════ */
.loc-aurora {
    position: relative;
    overflow: hidden;
    padding: 0;
    margin-top: 0;
    min-height: 420px;
    display: flex; flex-direction: column; align-items: stretch;
}

/* animated aurora mesh background */
.aurora-bg {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, #0a192f 0%, #0f2d4a 40%, #1a0533 100%);
    z-index: 0;
}
.aurora-layer {
    position: absolute; border-radius: 50%;
    filter: blur(70px); pointer-events: none;
    animation: aurora-drift 12s ease-in-out infinite alternate;
}
.aurora-layer:nth-child(1) {
    width: 60%; height: 400px; top: -100px; left: -10%;
    background: radial-gradient(ellipse, rgba(99,102,241,0.35) 0%, transparent 70%);
    animation-duration: 11s;
}
.aurora-layer:nth-child(2) {
    width: 50%; height: 350px; top: 50px; right: -5%;
    background: radial-gradient(ellipse, rgba(236,72,153,0.25) 0%, transparent 70%);
    animation-duration: 14s; animation-direction: alternate-reverse;
}
.aurora-layer:nth-child(3) {
    width: 40%; height: 300px; bottom: -80px; left: 30%;
    background: radial-gradient(ellipse, rgba(79,172,254,0.2) 0%, transparent 70%);
    animation-duration: 9s;
}
.aurora-layer:nth-child(4) {
    width: 30%; height: 250px; top: 20%; left: 55%;
    background: radial-gradient(ellipse, rgba(52,211,153,0.18) 0%, transparent 70%);
    animation-duration: 16s; animation-direction: alternate-reverse;
}
@keyframes aurora-drift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(40px, 30px) scale(1.15); }
}

/* SVG wave top border */
.aurora-wave {
    position: relative; z-index: 1;
    display: block; width: 100%;
    margin-bottom: -2px;
}

/* floating city bubbles */
.aurora-bubbles {
    position: absolute; inset: 0; z-index: 2; pointer-events: none; overflow: hidden;
}
.aurora-bubble {
    position: absolute;
    font-size: 2rem;
    opacity: 0.18;
    animation: bubble-float linear infinite;
    user-select: none;
}
@keyframes bubble-float {
    0%   { transform: translateY(100%) rotate(0deg);   opacity: 0; }
    10%  { opacity: 0.18; }
    90%  { opacity: 0.18; }
    100% { transform: translateY(-120%) rotate(360deg); opacity: 0; }
}

/* rotating ring decoration */
.aurora-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.07);
    pointer-events: none;
    animation: aurora-ring-spin 20s linear infinite;
}
.aurora-ring:nth-child(1) { width: 500px; height: 500px; top: -150px; right: -100px; animation-duration: 22s; }
.aurora-ring:nth-child(2) { width: 350px; height: 350px; bottom: -100px; left: -60px; animation-duration: 18s; animation-direction: reverse; }
@keyframes aurora-ring-spin { to { transform: rotate(360deg); } }

/* content */
.aurora-content {
    position: relative; z-index: 3;
    text-align: center;
    padding: 4.5rem 2rem 5rem;
    max-width: 680px; margin: 0 auto;
    color: white;
}
.aurora-badge {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 9999px; padding: 0.4rem 1.1rem;
    font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase;
    color: #a5b4fc; font-weight: 600; margin-bottom: 1.5rem;
    backdrop-filter: blur(6px);
}
.aurora-content h2 {
    font-size: clamp(2rem, 4vw, 3rem); font-weight: 900;
    color: white; margin-bottom: 1rem;
    background: linear-gradient(135deg, #fff 30%, #a5b4fc 65%, #f9a8d4 100%);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent; color: transparent;
    line-height: 1.15;
}
.aurora-content p {
    color: rgba(255,255,255,0.65); font-size: 1.05rem;
    max-width: 500px; margin: 0 auto 2.5rem;
    line-height: 1.7;
}
.aurora-btns {
    display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;
}
.aurora-btn-primary {
    display: inline-flex; align-items: center; gap: 0.6rem;
    background: linear-gradient(135deg, #6366f1, #a855f7);
    color: white; padding: 0.9rem 2rem; border-radius: 9999px;
    font-weight: 700; font-size: 1rem;
    box-shadow: 0 8px 24px rgba(99,102,241,0.45);
    transition: transform 0.3s, box-shadow 0.3s;
    text-decoration: none;
    animation: btn-pulse 3s ease-in-out infinite;
}
.aurora-btn-primary:hover {
    transform: translateY(-3px) scale(1.04);
    box-shadow: 0 14px 36px rgba(99,102,241,0.6);
}
@keyframes btn-pulse {
    0%,100% { box-shadow: 0 8px 24px rgba(99,102,241,0.45); }
    50%      { box-shadow: 0 8px 36px rgba(168,85,247,0.65); }
}
.aurora-btn-secondary {
    display: inline-flex; align-items: center; gap: 0.6rem;
    background: rgba(255,255,255,0.1); color: white;
    padding: 0.9rem 2rem; border-radius: 9999px;
    font-weight: 600; font-size: 1rem;
    border: 1px solid rgba(255,255,255,0.25);
    backdrop-filter: blur(6px);
    transition: background 0.3s, transform 0.3s;
    text-decoration: none;
}
.aurora-btn-secondary:hover {
    background: rgba(255,255,255,0.18);
    transform: translateY(-3px);
}

/* floating stat badges around the CTA */
.aurora-stat-badges {
    display: flex; justify-content: center; gap: 1.5rem;
    margin-top: 2.5rem; flex-wrap: wrap;
}
.aurora-stat-badge {
    display: flex; align-items: center; gap: 0.5rem;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 9999px; padding: 0.45rem 1.1rem;
    font-size: 0.82rem; color: rgba(255,255,255,0.75);
    backdrop-filter: blur(4px);
}
.aurora-stat-badge i { color: #a5b4fc; }

/* ══ RESPONSIVE ══════════════════════════════════ */
@media (max-width: 768px) {
    .loc-grid { grid-template-columns: 1fr 1fr; gap: 1.1rem; }
    .loc-card.remote { grid-column: span 2; }
    .loc-stats-strip { gap: 1.2rem; }
    .loc-stat-divider { display: none; }
    .loc-info-strip { gap: 1.5rem; }
}
@media (max-width: 540px) {
    .loc-grid { grid-template-columns: 1fr; }
    .loc-card.remote { grid-column: span 1; }
    .loc-card { min-height: 220px; }
    .globe-ring-wrapper { display: none; }
}

/* ═══════════════════════════════════════════════
   SCROLL ANIMATIONS
═══════════════════════════════════════════════ */

/* ── Scroll progress bar ── */
#scroll-progress-bar {
    position: fixed;
    top: 0; left: 0;
    height: 3px;
    width: 0%;
    background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899, #f43f5e);
    background-size: 200% 100%;
    z-index: 9999;
    transition: width 0.05s linear;
    animation: progress-shimmer 2s linear infinite;
    box-shadow: 0 0 10px rgba(99,102,241,0.6);
}
@keyframes progress-shimmer {
    0%   { background-position: 0% 0; }
    100% { background-position: 200% 0; }
}

/* ── Base hidden states for scroll-reveal ── */
.sr-fade-up   { opacity: 0; transform: translateY(60px);  transition: opacity 0.7s ease, transform 0.7s ease; }
.sr-fade-left { opacity: 0; transform: translateX(-70px); transition: opacity 0.7s ease, transform 0.7s ease; }
.sr-fade-right{ opacity: 0; transform: translateX(70px);  transition: opacity 0.7s ease, transform 0.7s ease; }
.sr-scale     { opacity: 0; transform: scale(0.82);        transition: opacity 0.65s ease, transform 0.65s ease; }
.sr-clip      { opacity: 0; clip-path: inset(0 100% 0 0);  transition: opacity 0.7s ease, clip-path 0.8s cubic-bezier(0.25,0.8,0.25,1); }
.sr-rotate    { opacity: 0; transform: rotateY(-25deg) translateX(-40px); transition: opacity 0.7s ease, transform 0.8s cubic-bezier(0.25,0.8,0.25,1); }

/* visible state (added by JS) */
.sr-visible {
    opacity: 1 !important;
    transform: none !important;
    clip-path: inset(0 0% 0 0) !important;
}

/* ── Section heading reveal ── */
.loc-section-head h2 { transition: opacity 0.8s ease, transform 0.8s cubic-bezier(0.25,0.8,0.25,1); }
.loc-section-head p  { transition: opacity 0.8s 0.15s ease, transform 0.8s 0.15s cubic-bezier(0.25,0.8,0.25,1); }

/* ── Hero parallax layers ── */
.loc-hero-content { will-change: transform; }
.loc-orb-1, .loc-orb-2, .loc-orb-3 { will-change: transform; }
.globe-ring-wrapper { will-change: transform; }

/* ── Info strip items ── */
.loc-info-item { transition: opacity 0.6s ease, transform 0.6s ease; }

/* ── Aurora section ── */
.loc-aurora .aurora-content { will-change: transform; }
.loc-aurora .aurora-bg     { will-change: transform; }
</style>
@endpush

@php
$totalJobs = collect($locationData)->sum('job_count');
$totalCities = count($locationData);
@endphp

@section('content')

{{-- ══ HERO ══════════════════════════════════════════ --}}
<section class="loc-hero">
    {{-- particles canvas --}}
    <canvas id="loc-particles"></canvas>

    {{-- orbs --}}
    <div class="loc-orb loc-orb-1"></div>
    <div class="loc-orb loc-orb-2"></div>
    <div class="loc-orb loc-orb-3"></div>

    {{-- 3-D globe rings --}}
    <div class="globe-ring-wrapper" aria-hidden="true">
        <div class="globe-ring"></div>
        <div class="globe-ring"></div>
        <div class="globe-ring"></div>
        <div class="globe-ring"></div>
    </div>

    {{-- content --}}
    <div class="loc-hero-content">
        <div class="loc-eyebrow">
            <i class="fa-solid fa-location-dot"></i>
            Job Locations
        </div>

        <h1>Find Jobs<br>Near You</h1>

        <p>Discover opportunities in India's top tech hubs and cities — or work from anywhere in the world.</p>

        <div class="loc-stats-strip">
            <div class="loc-stat">
                <span class="loc-stat-num" id="hero-total-jobs">{{ $totalJobs }}</span>
                <span class="loc-stat-lbl">Live Jobs</span>
            </div>
            <div class="loc-stat-divider"></div>
            <div class="loc-stat">
                <span class="loc-stat-num">{{ $totalCities }}</span>
                <span class="loc-stat-lbl">Cities</span>
            </div>
            <div class="loc-stat-divider"></div>
            <div class="loc-stat">
                <span class="loc-stat-num">100%</span>
                <span class="loc-stat-lbl">Free to Apply</span>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <i class="fa-solid fa-chevron-down"></i>
        Scroll to explore
    </div>
</section>

{{-- ══ CITY GRID ══════════════════════════════════════ --}}
<section class="loc-section">
    <div class="container">
        <div class="loc-section-head">
            <h2>Choose Your City</h2>
            <p>Click any city to browse all open roles in that location</p>
        </div>

        <div class="loc-grid" id="loc-grid">
            @foreach($locationData as $index => $loc)
            <a href="{{ route('jobs.index', ['location' => $loc['name']]) }}"
               class="loc-card {{ $loc['name'] === 'Remote' ? 'remote' : '' }}"
               style="
                   --card-gradient: {{ $loc['gradient'] }};
                   animation-delay: {{ $index * 0.08 }}s;
               "
               data-tilt>

                {{-- gradient bg --}}
                <div class="loc-card-bg"></div>
                <div class="loc-card-noise"></div>

                {{-- big deco icon --}}
                <i class="{{ $loc['icon'] }} loc-deco-icon" aria-hidden="true"></i>

                {{-- content --}}
                <div class="loc-card-content">
                    {{-- small icon --}}
                    <div class="loc-icon-badge">
                        <i class="{{ $loc['icon'] }}"></i>
                    </div>

                    <div class="loc-city">{{ $loc['emoji'] }} {{ $loc['name'] }}</div>
                    <div class="loc-state">{{ $loc['state'] }}</div>
                    <div class="loc-tagline">{{ $loc['tagline'] }}</div>

                    <div class="loc-card-bottom">
                        <div class="loc-count-pill">
                            <i class="fa-solid fa-briefcase" style="font-size:0.7rem;"></i>
                            <span class="loc-count-num">{{ $loc['job_count'] }}</span>
                            Openings
                        </div>
                        <div class="loc-arrow-btn">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- info strip --}}
        <div class="loc-info-strip">
            <div class="loc-info-item">
                <div class="loc-info-icon" style="background: linear-gradient(135deg,#f43f5e,#fb923c);">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div class="loc-info-text">
                    <strong>Instant Apply</strong>
                    <span>Apply in under 2 minutes</span>
                </div>
            </div>
            <div class="loc-info-item">
                <div class="loc-info-icon" style="background: linear-gradient(135deg,#0ea5e9,#6366f1);">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="loc-info-text">
                    <strong>Job Alerts</strong>
                    <span>Get notified for new roles</span>
                </div>
            </div>
            <div class="loc-info-item">
                <div class="loc-info-icon" style="background: linear-gradient(135deg,#10b981,#14b8a6);">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="loc-info-text">
                    <strong>Verified Listings</strong>
                    <span>All jobs manually reviewed</span>
                </div>
            </div>
            <div class="loc-info-item">
                <div class="loc-info-icon" style="background: linear-gradient(135deg,#8b5cf6,#ec4899);">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <div class="loc-info-text">
                    <strong>Remote Friendly</strong>
                    <span>Work from anywhere roles</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ AURORA ANIMATED CTA ══════════════════════════ --}}
<section class="loc-aurora">
    {{-- aurora mesh layers --}}
    <div class="aurora-bg">
        <div class="aurora-layer"></div>
        <div class="aurora-layer"></div>
        <div class="aurora-layer"></div>
        <div class="aurora-layer"></div>
    </div>

    {{-- decorative rings --}}
    <div class="aurora-ring"></div>
    <div class="aurora-ring"></div>

    {{-- SVG wave top --}}
    <svg class="aurora-wave" viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,40 C240,80 480,0 720,40 C960,80 1200,0 1440,40 L1440,0 L0,0 Z" fill="#f4f7fb"/>
    </svg>

    {{-- floating city emoji bubbles --}}
    <div class="aurora-bubbles" id="aurora-bubbles"></div>

    {{-- CTA content --}}
    <div class="aurora-content">
        <div class="aurora-badge">
            <i class="fa-solid fa-location-dot"></i>
            Your Next Opportunity Awaits
        </div>

        <h2>Ready to Find Your<br>Dream Job?</h2>

        <p>Thousands of top companies across India are actively hiring. Search across all cities and find the perfect role for you.</p>

        <div class="aurora-btns">
            <a href="{{ route('jobs.index') }}" class="aurora-btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Browse All Jobs
            </a>
            <a href="{{ route('profile.onboarding') }}" class="aurora-btn-secondary">
                <i class="fa-solid fa-user-plus"></i>
                Create Free Account
            </a>
        </div>

        <div class="aurora-stat-badges">
            <div class="aurora-stat-badge">
                <i class="fa-solid fa-briefcase"></i>
                {{ $totalJobs }} Live Jobs
            </div>
            <div class="aurora-stat-badge">
                <i class="fa-solid fa-building"></i>
                500+ Companies
            </div>
            <div class="aurora-stat-badge">
                <i class="fa-solid fa-map-location-dot"></i>
                {{ $totalCities }} Cities
            </div>
            <div class="aurora-stat-badge">
                <i class="fa-solid fa-bolt"></i>
                Instant Apply
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
/* ── Floating Particles Canvas ───────────────────── */
(function() {
    const canvas = document.getElementById('loc-particles');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H, particles = [];
    const N = 55;

    function resize() {
        W = canvas.width  = canvas.offsetWidth;
        H = canvas.height = canvas.offsetHeight;
    }
    window.addEventListener('resize', resize);
    resize();

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x  = Math.random() * W;
            this.y  = Math.random() * H;
            this.r  = Math.random() * 1.8 + 0.4;
            this.vx = (Math.random() - 0.5) * 0.35;
            this.vy = (Math.random() - 0.5) * 0.35;
            this.alpha = Math.random() * 0.5 + 0.1;
        }
        update() {
            this.x += this.vx; this.y += this.vy;
            if (this.x < 0 || this.x > W || this.y < 0 || this.y > H) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(165,180,252,${this.alpha})`;
            ctx.fill();
        }
    }

    for (let i = 0; i < N; i++) particles.push(new Particle());

    // draw lines between close particles
    function drawLines() {
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 110) {
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(165,180,252,${0.12 * (1 - dist/110)})`;
                    ctx.lineWidth = 0.6;
                    ctx.stroke();
                }
            }
        }
    }

    (function loop() {
        ctx.clearRect(0, 0, W, H);
        particles.forEach(p => { p.update(); p.draw(); });
        drawLines();
        requestAnimationFrame(loop);
    })();

    // mouse repel
    canvas.parentElement.addEventListener('mousemove', e => {
        const rect = canvas.getBoundingClientRect();
        const mx = e.clientX - rect.left, my = e.clientY - rect.top;
        particles.forEach(p => {
            const dx = p.x - mx, dy = p.y - my;
            const d = Math.sqrt(dx*dx+dy*dy);
            if (d < 80) {
                p.vx += dx / d * 0.4;
                p.vy += dy / d * 0.4;
            }
        });
    });
})();

/* ── 3-D Tilt on cards ───────────────────────────── */
(function() {
    const MAX_TILT = 14; // degrees

    document.querySelectorAll('[data-tilt]').forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const cx = rect.left + rect.width  / 2;
            const cy = rect.top  + rect.height / 2;
            const dx = (e.clientX - cx) / (rect.width  / 2);
            const dy = (e.clientY - cy) / (rect.height / 2);
            const rotY =  dx * MAX_TILT;
            const rotX = -dy * MAX_TILT;

            this.style.transform =
                `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg) scale(1.04)`;
            this.style.boxShadow =
                `${-rotY * 1.2}px ${rotX * 1.2}px 40px ${this.style.getPropertyValue('--card-glow') || 'rgba(99,102,241,0.4)'}`;
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(800px) rotateX(0) rotateY(0) scale(1)';
            this.style.boxShadow = '0 8px 24px rgba(10,25,47,0.12)';
            this.style.transition = 'transform 0.55s cubic-bezier(0.25,0.8,0.25,1), box-shadow 0.55s';
        });

        card.addEventListener('mouseenter', function() {
            this.style.transition = 'transform 0.08s linear, box-shadow 0.08s linear';
        });
    });
})();

/* ── Scroll-reveal stagger ───────────────────────── */
(function() {
    if (!('IntersectionObserver' in window)) return;
    const cards = document.querySelectorAll('.loc-card');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    cards.forEach(c => { c.style.opacity = '0'; io.observe(c); });
})();

/* ── Counter animation on hero stat ─────────────── */
(function() {
    const el = document.getElementById('hero-total-jobs');
    if (!el) return;
    const target = parseInt(el.textContent, 10);
    let current = 0;
    const step = Math.ceil(target / 50);
    const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current.toLocaleString('en-IN');
        if (current >= target) clearInterval(timer);
    }, 28);
})();
/* ════════════════════════════════════════════════
   SCROLL ANIMATION ENGINE
════════════════════════════════════════════════ */
(function() {
    /* ── 1. Scroll progress bar ─────────────────── */
    const bar = document.createElement('div');
    bar.id = 'scroll-progress-bar';
    document.body.prepend(bar);

    function updateBar() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        bar.style.width = pct + '%';
    }

    /* ── 2. Hero parallax ───────────────────────── */
    const heroContent = document.querySelector('.loc-hero-content');
    const orb1 = document.querySelector('.loc-orb-1');
    const orb2 = document.querySelector('.loc-orb-2');
    const orb3 = document.querySelector('.loc-orb-3');
    const globeRing = document.querySelector('.globe-ring-wrapper');
    const heroHeight = document.querySelector('.loc-hero')?.offsetHeight || 520;

    function updateParallax() {
        const sy = window.scrollY;
        if (sy > heroHeight * 1.5) return; // stop computing off-screen
        const ratio = sy / heroHeight;

        if (heroContent) {
            heroContent.style.transform = `translateY(${sy * 0.28}px)`;
            heroContent.style.opacity = Math.max(0, 1 - ratio * 1.8);
        }
        if (orb1)      orb1.style.transform      = `translateY(${sy * 0.18}px) translateX(${sy * 0.05}px)`;
        if (orb2)      orb2.style.transform      = `translateY(${sy * -0.12}px) translateX(${sy * -0.04}px)`;
        if (orb3)      orb3.style.transform      = `translateY(${sy * 0.22}px)`;
        if (globeRing) globeRing.style.transform = `translate(-50%,-50%) translateY(${sy * 0.1}px) scale(${1 + ratio * 0.08})`;
    }

    /* ── 3. Aurora section parallax ────────────── */
    const auroraSection = document.querySelector('.loc-aurora');
    const auroraBg     = document.querySelector('.loc-aurora .aurora-bg');
    const auroraLayers = document.querySelectorAll('.aurora-layer');
    const auroraContent= document.querySelector('.aurora-content');

    function updateAuroraParallax() {
        if (!auroraSection) return;
        const rect = auroraSection.getBoundingClientRect();
        const vis  = 1 - rect.top / window.innerHeight; // 0..1 as section scrolls in
        if (vis < 0 || vis > 2) return;

        const shift = (vis - 0.5) * 60;
        if (auroraBg)      auroraBg.style.transform      = `translateY(${shift * 0.4}px)`;
        if (auroraContent) auroraContent.style.transform = `translateY(${shift * -0.18}px)`;

        auroraLayers.forEach((l, i) => {
            const dir = i % 2 === 0 ? 1 : -1;
            l.style.transform = `translateY(${shift * 0.25 * dir}px) translateX(${shift * 0.12 * dir}px) scale(${1 + vis * 0.06})`;
        });
    }

    /* ── 4. Card fly-in (Intersection Observer) ─ */
    const cards = document.querySelectorAll('.loc-card');
    cards.forEach((card, i) => {
        // alternate left/right/up for variety
        const dir = i % 3 === 0 ? 'sr-fade-left'
                  : i % 3 === 1 ? 'sr-fade-right'
                  : 'sr-fade-up';
        card.classList.add(dir);
        card.style.transitionDelay = `${(i % 4) * 0.09}s`; // stagger per row
    });

    /* ── 5. Section heading clip-reveal ─────────── */
    document.querySelectorAll('.loc-section-head h2').forEach(el => el.classList.add('sr-clip'));
    document.querySelectorAll('.loc-section-head p').forEach(el => el.classList.add('sr-fade-up'));

    /* ── 6. Info strip items ────────────────────── */
    document.querySelectorAll('.loc-info-item').forEach((el, i) => {
        el.classList.add('sr-scale');
        el.style.transitionDelay = `${i * 0.1}s`;
    });

    /* ── 7. Aurora badge / heading / btns ─────── */
    ['.aurora-badge', '.aurora-content h2', '.aurora-content p',
     '.aurora-btns', '.aurora-stat-badges'].forEach((sel, i) => {
        document.querySelectorAll(sel).forEach(el => {
            el.classList.add('sr-fade-up');
            el.style.transitionDelay = `${i * 0.12}s`;
        });
    });

    /* ── 8. Intersection Observer ─────────────── */
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('sr-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll(
        '.sr-fade-up, .sr-fade-left, .sr-fade-right, .sr-scale, .sr-clip, .sr-rotate'
    ).forEach(el => io.observe(el));

    /* ── 9. Scroll event fan-out ────────────────── */
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                updateBar();
                updateParallax();
                updateAuroraParallax();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    // initial run
    updateBar();
    updateParallax();
    updateAuroraParallax();
})();

/* ── Aurora floating emoji bubbles ──────────────── */
(function() {
    const container = document.getElementById('aurora-bubbles');
    if (!container) return;

    const emojis = ['🌆','🏙️','🌃','🌉','🏢','🌐','✈️','🗺️','📍','🏗️','🌊','🌿','🎓','💎','🚀','⚡','🔮','🌟'];
    const N = 18;

    for (let i = 0; i < N; i++) {
        const el = document.createElement('span');
        el.className = 'aurora-bubble';
        el.textContent = emojis[i % emojis.length];

        const size   = Math.random() * 1.5 + 1.2;
        const left   = Math.random() * 95;
        const delay  = Math.random() * 12;
        const dur    = Math.random() * 10 + 10;

        el.style.cssText = `
            left: ${left}%;
            bottom: -60px;
            font-size: ${size}rem;
            animation-delay: ${delay}s;
            animation-duration: ${dur}s;
        `;
        container.appendChild(el);
    }
})();
</script>
@endpush
