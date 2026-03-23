<style>
    #musicModal {
        --music-bg: #EFE7DA;
        --music-surface: #F8F3EA;
        --music-surface-2: #E6DBCA;
        --music-border: #B59B79;
        --music-primary: #443C3D;
        --music-muted: #7B6E63;
        --music-text: #2E292A;
        --music-danger: #9B2F2F;
        --music-hero-a: #7d5f43;
        --music-hero-b: #5b4331;
        --music-hero-c: #35241b;
    }

    body.dark-mode #musicModal {
        --music-bg: #1C1819;
        --music-surface: #272022;
        --music-surface-2: #342C2E;
        --music-border: #B59B79;
        --music-primary: #B59B79;
        --music-muted: #D0C4B4;
        --music-text: #E2D8CC;
        --music-danger: #E17B7B;
        --music-hero-a: #8a6647;
        --music-hero-b: #583f2f;
        --music-hero-c: #271a14;
    }

    #musicModal .music-app-window {
        position: fixed;
        top: 24px;
        left: 50%;
        transform: translateX(-50%);
        width: 95vw;
        height: 92vh;
        display: flex;
        flex-direction: column;
        border: 2px solid var(--music-border);
        border-radius: 1rem;
        overflow: hidden;
        background: var(--music-bg);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        resize: both;
        user-select: none;
        pointer-events: auto;
        color: var(--music-text);
    }

    #musicModal .music-app-window.maximized {
        top: 0;
        left: 0;
        width: 100%;
        height: calc(100vh - 72px);
        transform: none;
        border-radius: 0;
        resize: none;
    }

    #musicModal .window-header {
        height: 52px;
        background: var(--music-primary);
        color: var(--music-bg);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 16px;
        cursor: move;
        flex-shrink: 0;
    }

    #musicModal .window-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
    }

    #musicModal .window-controls {
        display: flex;
        gap: 10px;
    }

    #musicModal .window-btn {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.18);
        color: inherit;
        cursor: pointer;
    }

    #musicModal .window-btn:hover { background: rgba(255, 255, 255, 0.32); }
    #musicModal .window-btn.close:hover { background: var(--music-danger); color: #fff; }

    #musicModal .resize-handle {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 20px;
        height: 20px;
        cursor: se-resize;
        background: linear-gradient(135deg, transparent 50%, var(--music-primary) 50%);
        opacity: 0.35;
    }

    #musicModal .music-app-window.maximized .resize-handle { display: none; }

    #musicModal .music-window-body {
        flex: 1;
        min-height: 0;
        display: grid;
        grid-template-columns: 260px 1fr;
    }

    #musicModal .music-sidebar {
        background: linear-gradient(180deg, #2d2322 0%, #241b1b 100%);
        border-right: 2px solid #4b3730;
        padding: 1rem;
        overflow: auto;
        color: #fff;
    }

    #musicModal .sidebar-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.55rem;
    }

    #musicModal .sidebar-toggle-btn {
        width: 28px;
        height: 28px;
        border-radius: 0.45rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.08);
        color: #e8d7c5;
        cursor: pointer;
        flex-shrink: 0;
    }

    #musicModal .sidebar-logo {
        font-size: 1.35rem;
        color: #d0a977;
    }

    #musicModal .sidebar-brand {
        font-weight: 800;
        font-size: 1.3rem;
        line-height: 1;
    }

    #musicModal .sidebar-nav {
        margin-top: 1rem;
        display: grid;
        gap: 0.4rem;
    }

    #musicModal .sidebar-nav-btn {
        border: none;
        border-radius: 0.55rem;
        background: transparent;
        color: #e0cdb7;
        text-align: left;
        padding: 0.55rem 0.65rem;
        display: flex;
        align-items: center;
        gap: 0.55rem;
        cursor: pointer;
        font-weight: 600;
    }

    #musicModal .sidebar-nav-btn.active {
        background: rgba(209, 170, 118, 0.2);
        color: #fff;
    }

    #musicModal .sidebar-section-title {
        margin-top: 1rem;
        color: #b89f8a;
        font-size: 0.73rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    #musicModal .playlist-list {
        display: grid;
        gap: 0.5rem;
        margin-top: 0.65rem;
    }

    #musicModal .playlist-item {
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 0.7rem;
        background: rgba(255, 255, 255, 0.06);
        padding: 0.5rem;
        display: grid;
        grid-template-columns: 44px 1fr;
        gap: 0.6rem;
        align-items: center;
        cursor: pointer;
        color: #fff;
    }

    #musicModal .playlist-item.active {
        border-width: 2px;
        border-color: #d0a977;
        background: rgba(208, 169, 119, 0.2);
    }

    #musicModal .playlist-cover {
        width: 44px;
        height: 44px;
        border-radius: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        object-fit: cover;
        background: #2a2f3a;
    }

    #musicModal .music-app-window.sidebar-collapsed .music-window-body {
        grid-template-columns: 92px 1fr;
    }

    #musicModal .music-app-window.sidebar-collapsed .sidebar-brand,
    #musicModal .music-app-window.sidebar-collapsed .sidebar-nav-btn span,
    #musicModal .music-app-window.sidebar-collapsed .sidebar-section-title,
    #musicModal .music-app-window.sidebar-collapsed .sidebar-meta-row,
    #musicModal .music-app-window.sidebar-collapsed #musicGuestHint,
    #musicModal .music-app-window.sidebar-collapsed .playlist-item .min-w-0 {
        display: none;
    }

    #musicModal .music-app-window.sidebar-collapsed .music-sidebar {
        padding: 0.75rem 0.5rem;
    }

    #musicModal .music-app-window.sidebar-collapsed .sidebar-head {
        justify-content: center;
    }

    #musicModal .music-app-window.sidebar-collapsed .sidebar-nav {
        justify-items: center;
    }

    #musicModal .music-app-window.sidebar-collapsed .sidebar-nav-btn {
        width: 42px;
        height: 42px;
        justify-content: center;
        padding: 0;
        border-radius: 0.6rem;
    }

    #musicModal .music-app-window.sidebar-collapsed .playlist-list {
        justify-items: center;
        margin-top: 0.35rem;
    }

    #musicModal .music-app-window.sidebar-collapsed .playlist-item {
        width: 56px;
        grid-template-columns: 1fr;
        justify-items: center;
        padding: 0.35rem;
        gap: 0;
    }

    #musicModal .music-app-window.sidebar-collapsed .playlist-cover {
        width: 48px;
        height: 48px;
    }

    #musicModal .music-main {
        min-height: 0;
        background: var(--music-surface);
    }

    #musicModal .music-home {
        height: 100%;
        min-height: 0;
        display: grid;
        grid-template-rows: auto 1fr auto;
        background: #1b1312;
    }

    #musicModal .music-hero {
        padding: 1.35rem;
        display: grid;
        grid-template-columns: 210px 1fr auto;
        gap: 1.5rem;
        align-items: center;
        min-height: 275px;
        color: #f7f9fd;
        background: linear-gradient(180deg, var(--music-hero-a) 0%, var(--music-hero-b) 68%, var(--music-hero-c) 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    #musicModal .cover-large {
        width: 200px;
        height: 200px;
        border-radius: 0.75rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
        object-fit: cover;
        background: #2b2f37;
    }

    #musicModal .hero-title {
        font-size: 4rem;
        font-weight: 900;
        line-height: 0.94;
    }

    #musicModal #musicHeroSubtitle {
        font-size: 1.24rem;
        line-height: 1.38;
        font-weight: 500;
    }

    #musicModal .hero-actions {
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }

    #musicModal .hero-play-btn {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        border: 2px solid rgba(46, 32, 24, 0.28);
        background: #d0a977;
        color: #2f2118;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.22);
    }

    body.dark-mode #musicModal .hero-play-btn {
        border-color: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    #musicModal .hero-pill-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
        cursor: pointer;
    }

    #musicModal .tracks-wrap {
        min-height: 0;
        overflow: auto;
        padding: 0.75rem 1rem 1rem;
        background: #1b1312;
    }

    #musicModal .tracks-head {
        display: grid;
        grid-template-columns: 44px 58px 1.5fr 1fr 64px auto auto;
        gap: 0.7rem;
        color: #b7a694;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0.2rem 0.45rem 0.5rem;
    }

    #musicModal .track-row {
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.7rem;
        background: rgba(255, 255, 255, 0.04);
        display: grid;
        grid-template-columns: 44px 58px 1.5fr 1fr 64px auto auto;
        gap: 0.7rem;
        align-items: center;
        padding: 0.55rem 0.7rem;
        min-height: 74px;
        margin-bottom: 0.5rem;
        color: #fff;
    }

    #musicModal .track-row.active {
        border-width: 2px;
        border-color: #d0a977;
        background: rgba(208, 169, 119, 0.25);
    }

    #musicModal .track-thumb {
        width: 58px;
        height: 58px;
        border-radius: 0.45rem;
        object-fit: cover;
        border: 1px solid rgba(255, 255, 255, 0.14);
        background: #2b2f3a;
    }

    #musicModal .track-title {
        font-weight: 700;
        font-size: 0.98rem;
        line-height: 1.1;
    }

    #musicModal .track-author,
    #musicModal .track-album,
    #musicModal .track-duration,
    #musicModal .muted {
        color: #c8b8a8;
        font-size: 0.83rem;
    }

    #musicModal .track-album {
        font-size: 0.92rem;
        font-weight: 600;
    }

    #musicModal .player-area {
        border-top: 1px solid rgba(255, 255, 255, 0.12);
        background: linear-gradient(180deg, #4a2f24 0%, #3a231b 100%);
        padding: 0.55rem 0.8rem;
        display: grid;
        grid-template-columns: minmax(210px, 0.95fr) minmax(320px, 1.5fr) auto minmax(130px, 0.6fr);
        gap: 0.8rem;
        align-items: center;
        position: relative;
    }

    body.dark-mode #musicModal .player-area {
        background: linear-gradient(180deg, #251813 0%, #17100d 100%);
        border-top-color: rgba(255, 255, 255, 0.1);
    }

    #musicModal .player-now {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        min-width: 0;
    }

    #musicModal .player-now-thumb {
        width: 44px;
        height: 44px;
        border-radius: 0.35rem;
        object-fit: cover;
        border: 1px solid rgba(255, 255, 255, 0.18);
        background: #6b4a3e;
        flex-shrink: 0;
    }

    #musicModal .player-now-meta {
        min-width: 0;
    }

    #musicModal .player-now-meta #musicNowTitle {
        color: #fff !important;
        font-size: 0.76rem;
        font-weight: 700;
        line-height: 1.2;
    }

    #musicModal .player-now-meta #musicNowAuthor {
        color: #d8c3b5;
        font-size: 0.64rem;
        margin-top: 0.08rem;
    }

    body.dark-mode #musicModal .player-now-meta #musicNowAuthor {
        color: #f0dfd4;
    }

    #musicModal .player-now-like {
        display: none;
    }

    #musicModal .player-controls {
        display: block;
        width: 100%;
        max-width: none;
        justify-self: center;
    }

    #musicModal .player-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.35rem;
    }

    #musicModal .player-btn {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.22);
        background: radial-gradient(circle at 30% 30%, #8a5e4a 0%, #664535 68%, #4f3428 100%);
        color: #fff;
        cursor: pointer;
        transition: transform 0.14s ease, box-shadow 0.14s ease;
        box-shadow: 0 4px 9px rgba(0, 0, 0, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.18);
    }

    body.dark-mode #musicModal .player-btn {
        background: radial-gradient(circle at 30% 30%, #5a3d31 0%, #3f2a21 68%, #2e1f18 100%);
        border-color: rgba(255, 255, 255, 0.16);
    }

    #musicModal .player-btn.primary {
        width: 34px;
        height: 34px;
        background: radial-gradient(circle at 30% 30%, #b07a60 0%, #8a5f49 72%, #6f4938 100%);
        color: #fff;
        border-radius: 50%;
        border-color: rgba(255, 255, 255, 0.28);
    }

    body.dark-mode #musicModal .player-btn.primary {
        background: radial-gradient(circle at 30% 30%, #7f5a47 0%, #5d3f31 72%, #462e24 100%);
    }

    #musicModal .player-btn.active {
        background: radial-gradient(circle at 30% 30%, #d0a883 0%, #b78c66 72%, #987150 100%);
        color: #2d1d15;
    }

    #musicModal .player-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.32), inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    #musicModal .player-progress {
        display: grid;
        grid-template-columns: 34px 1fr 34px;
        align-items: center;
        gap: 0.35rem;
    }

    #musicModal .player-time {
        color: #f6ede7;
        font-size: 0.62rem;
        text-align: center;
        font-variant-numeric: tabular-nums;
        font-weight: 700;
    }

    #musicModal .player-progress-range,
    #musicModal .player-volume-range {
        width: 100%;
        accent-color: #c99873;
        cursor: pointer;
    }

    #musicModal .player-progress-range,
    #musicModal .player-volume-range {
        -webkit-appearance: none;
        appearance: none;
        height: 8px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.26);
    }

    #musicModal .player-progress-range::-webkit-slider-thumb,
    #musicModal .player-volume-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #f2dfd2;
        border: 1px solid rgba(58, 36, 27, 0.55);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);
    }

    body.dark-mode #musicModal .player-progress-range,
    body.dark-mode #musicModal .player-volume-range {
        background: rgba(255, 255, 255, 0.2);
    }

    #musicModal .player-volume {
        display: grid;
        grid-template-columns: 20px 1fr;
        align-items: center;
        gap: 0.3rem;
        color: #fff;
        width: 100%;
        max-width: 130px;
        justify-self: end;
    }

    #musicModal .player-volume i {
        font-size: 0.7rem;
    }

    #musicModal .embed-wrap {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
        overflow: hidden;
    }

    #musicModal .embed-wrap audio {
        width: 100%;
        height: 100%;
        border: 0;
    }

    #musicModal .music-admin-section {
        height: 100%;
        overflow: auto;
        background: color-mix(in srgb, var(--music-surface) 94%, #6D63A7 6%);
        padding: 1rem;
    }

    #musicModal .music-admin-section h4 {
        font-weight: 800;
        margin-bottom: 0.6rem;
    }

    #musicModal .admin-tabs {
        margin-bottom: 0.7rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem;
    }

    #musicModal .admin-tab-btn {
        border: 1px solid var(--music-border);
        background: var(--music-bg);
        color: var(--music-muted);
        border-radius: 0.65rem;
        padding: 0.5rem 0.72rem;
        font-size: 0.82rem;
        font-weight: 700;
        cursor: pointer;
    }

    #musicModal .admin-tab-btn.active {
        background: var(--music-primary);
        color: var(--music-bg);
        border-color: transparent;
    }

    #musicModal .admin-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.7rem;
    }

    #musicModal .admin-box {
        border: 1px solid var(--music-border);
        border-radius: 0.7rem;
        background: var(--music-surface);
        padding: 0.7rem;
        color: var(--music-text);
    }

    #musicModal .field,
    #musicModal .select,
    #musicModal .textarea {
        width: 100%;
        border: 1px solid var(--music-border);
        background: var(--music-bg);
        color: var(--music-text);
        border-radius: 0.6rem;
        padding: 0.55rem 0.65rem;
        font-size: 0.92rem;
        outline: none;
    }

    #musicModal .field:focus,
    #musicModal .select:focus,
    #musicModal .textarea:focus {
        box-shadow: 0 0 0 2px color-mix(in srgb, #6D63A7 45%, transparent);
    }

    #musicModal .btn {
        border: none;
        border-radius: 0.6rem;
        background: var(--music-primary);
        color: var(--music-bg);
        padding: 0.55rem 0.75rem;
        font-weight: 700;
        cursor: pointer;
        font-size: 0.85rem;
    }

    #musicModal .btn.ghost {
        background: transparent;
        color: var(--music-primary);
        border: 1px solid var(--music-border);
    }

    #musicModal .btn.danger {
        background: var(--music-danger);
        color: #fff;
    }

    #musicModal .cover-picker {
        border: 1px dashed var(--music-border);
        border-radius: 0.7rem;
        background: var(--music-bg);
        padding: 0.65rem;
    }

    #musicModal .cover-picker-preview {
        width: 100%;
        height: 120px;
        border-radius: 0.6rem;
        border: 1px solid var(--music-border);
        object-fit: cover;
        background: var(--music-surface-2);
    }

    #musicModal .cover-picker-preview-shell {
        width: 100%;
        height: 120px;
        border-radius: 0.6rem;
        border: 1px solid var(--music-border);
        background: var(--music-surface-2);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    #musicModal .cover-picker-preview-shell .cover-picker-preview {
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 0;
        display: none;
    }

    #musicModal .cover-picker-preview-shell:not(.is-empty) .cover-picker-preview {
        display: block;
    }

    #musicModal .cover-picker-empty-icon {
        color: color-mix(in srgb, var(--music-muted) 78%, #fff 22%);
        font-size: 1.65rem;
        opacity: 0.9;
    }

    #musicModal .cover-picker-preview-shell:not(.is-empty) .cover-picker-empty-icon {
        display: none;
    }

    #musicModal .cover-picker-preview-shell.playlist-preview {
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }

    #musicModal .cover-picker-meta {
        margin-top: 0.45rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }

    #musicModal .cover-file-name {
        font-size: 0.78rem;
        color: var(--music-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #musicModal .admin-track-list {
        margin-top: 0.6rem;
        max-height: 250px;
        overflow: auto;
        display: grid;
        gap: 0.4rem;
    }

    #musicModal .admin-track-item {
        border: 1px solid var(--music-border);
        border-radius: 0.55rem;
        background: var(--music-bg);
        padding: 0.45rem 0.55rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }

    #musicModal .hidden { display: none !important; }

    @media (max-width: 1200px) {
        #musicModal .music-window-body { grid-template-columns: 220px 1fr; }
        #musicModal .music-hero { grid-template-columns: 130px 1fr; min-height: 205px; }
        #musicModal .cover-large { width: 130px; height: 130px; }
        #musicModal .hero-title { font-size: 2.5rem; }
        #musicModal #musicHeroSubtitle { font-size: 1.04rem; }
        #musicModal .hero-actions { display: none; }
        #musicModal .track-row,
        #musicModal .tracks-head {
            grid-template-columns: 38px 46px 1fr auto auto;
        }
        #musicModal .track-album,
        #musicModal .track-duration,
        #musicModal .hide-sm { display: none; }

        #musicModal .player-area {
            grid-template-columns: minmax(170px, 0.9fr) minmax(210px, 1.3fr) auto minmax(95px, 0.55fr);
            gap: 0.5rem;
            padding: 0.5rem 0.55rem;
        }

        #musicModal .player-now { gap: 0.45rem; }
        #musicModal .player-now-thumb { width: 36px; height: 36px; }
        #musicModal .player-now-meta #musicNowTitle { font-size: 0.67rem; }
        #musicModal .player-now-meta #musicNowAuthor { font-size: 0.58rem; }

        #musicModal .player-btn { width: 24px; height: 24px; }
        #musicModal .player-btn.primary { width: 30px; height: 30px; }

        #musicModal .player-progress { grid-template-columns: 28px 1fr 28px; gap: 0.25rem; }
        #musicModal .player-time { font-size: 0.55rem; }

        #musicModal .player-volume { grid-template-columns: 14px 1fr; max-width: 95px; gap: 0.2rem; }
        #musicModal .player-volume i { font-size: 0.6rem; }
        #musicModal .admin-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 900px) {
        #musicModal .player-area {
            grid-template-columns: minmax(0, 1fr) auto;
            grid-template-areas:
                "now volume"
                "controls controls"
                "buttons buttons";
            gap: 0.4rem;
            padding: 0.45rem 0.5rem;
        }

        #musicModal .player-now { grid-area: now; }
        #musicModal .player-controls { grid-area: controls; }
        #musicModal .player-buttons { grid-area: buttons; justify-content: center; }
        #musicModal .player-volume { grid-area: volume; max-width: 92px; justify-self: end; }

        #musicModal .player-now-meta #musicNowAuthor { display: none; }
    }
</style>

<div id="musicWindow" class="music-app-window">
    <div class="window-header">
        <div class="window-title">
            <i class="fas fa-music"></i>
            <span>Reproductor de Música</span>
        </div>
        <div class="window-controls">
            <button class="window-btn" type="button" onclick="minimizeMusic()"><i class="fa-solid fa-minus"></i></button>
            <button class="window-btn" type="button" onclick="toggleMaximizeMusic()" id="musicMaxBtn"><i class="fa-regular fa-square"></i></button>
            <button class="window-btn close" type="button" onclick="closeMusic()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>

    <div class="music-window-body">
        <aside class="music-sidebar">
            <div class="sidebar-head">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-music sidebar-logo"></i>
                    <div class="sidebar-brand">Soundwave</div>
                </div>
                <button id="musicSidebarToggleBtn" class="sidebar-toggle-btn" type="button" onclick="toggleMusicSidebar()" title="Contraer barra lateral">
                    <i class="fa-solid fa-angles-left"></i>
                </button>
            </div>

            <div class="sidebar-nav">
                <button id="musicHomeNavBtn" class="sidebar-nav-btn active" type="button" onclick="setMusicViewMode('home')">
                    <i class="fa-solid fa-house"></i>
                    <span>Inicio</span>
                </button>
                @if(($userType ?? 'guest') === 'admin')
                <button id="musicAdminNavBtn" class="sidebar-nav-btn" type="button" onclick="setMusicViewMode('admin')">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Admin</span>
                </button>
                @endif
            </div>

            <div class="sidebar-section-title">Tu biblioteca</div>
            <div class="sidebar-meta-row flex items-center justify-between mt-1">
                <span class="muted">Playlists</span>
                <span class="muted" id="musicPlaylistCount">0</span>
            </div>
            <div id="musicPlaylistList" class="playlist-list"></div>
            <div class="muted mt-2" id="musicGuestHint"></div>
        </aside>

        <section class="music-main">
            <div id="musicHomeSection" class="music-home">
                <div class="music-hero">
                    <img id="musicHeroCover" class="cover-large" src="https://via.placeholder.com/300x300.png?text=Playlist" alt="cover">
                    <div class="min-w-0">
                        <div class="muted uppercase tracking-wider" style="color:#f3dfc8;">Playlist</div>
                        <div id="musicHeroTitle" class="hero-title truncate">Sin playlist</div>
                        <div id="musicHeroSubtitle" class="muted mt-1" style="color:#e5cfb8;">Selecciona una playlist para ver sus canciones.</div>
                    </div>
                    <div class="hero-actions">
                        <button class="hero-play-btn" type="button" onclick="playActiveTrack()"><i class="fa-solid fa-play"></i></button>
                        <button class="hero-pill-btn" type="button"><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>

                <div id="musicTracksWrap" class="tracks-wrap"></div>

                <div class="player-area">
                    <div class="player-now">
                        <img id="musicNowThumb" class="player-now-thumb" src="https://via.placeholder.com/120x120.png?text=%E2%99%AA" alt="cover">
                        <div class="player-now-meta">
                            <div id="musicNowTitle" class="text-lg font-extrabold truncate" style="color:#f7e8d7;">Sin canción</div>
                            <div id="musicNowAuthor" class="muted truncate mt-1">Selecciona una canción para reproducir.</div>
                        </div>
                    </div>

                    <div class="player-controls">
                        <div class="player-progress">
                            <span id="musicCurrentTime" class="player-time">0:00</span>
                            <input id="musicProgressRange" class="player-progress-range" type="range" min="0" max="0" step="1" value="0" />
                            <span id="musicDurationTime" class="player-time">0:00</span>
                        </div>
                    </div>

                    <div class="player-buttons">
                        <button id="musicPrevBtn" class="player-btn" type="button" onclick="playPreviousTrackInPlaylist()" title="Anterior"><i class="fa-solid fa-backward-step"></i></button>
                        <button id="musicPlayPauseBtn" class="player-btn primary" type="button" onclick="togglePlayPause()" title="Reproducir / Pausar"><i class="fa-solid fa-play"></i></button>
                        <button id="musicNextBtn" class="player-btn" type="button" onclick="playNextTrackInPlaylist()" title="Siguiente"><i class="fa-solid fa-forward-step"></i></button>
                    </div>

                    <div class="player-volume">
                        <i class="fa-solid fa-volume-high"></i>
                        <input id="musicVolumeRange" class="player-volume-range" type="range" min="0" max="100" step="1" value="70" />
                    </div>

                    <div class="embed-wrap">
                        <audio id="musicAudioPlayer" preload="metadata"></audio>
                    </div>
                </div>
            </div>

            <div id="musicAdminSection" class="music-admin-section hidden">
                <h4>Panel Admin</h4>
                <div class="admin-tabs">
                    <button id="adminTabCreateBtn" class="admin-tab-btn active" type="button" onclick="setAdminPanelTab('create')">Crear playlist</button>
                    <button id="adminTabEditBtn" class="admin-tab-btn" type="button" onclick="setAdminPanelTab('edit')">Editar playlist</button>
                    <button id="adminTabTrackBtn" class="admin-tab-btn" type="button" onclick="setAdminPanelTab('track')">Agregar canción</button>
                </div>
                <div class="admin-grid">
                    <div id="adminCreatePanel" class="admin-box" style="grid-column: 1 / -1;">
                        <div class="font-semibold mb-2">Crear playlist</div>
                        <div class="space-y-2">
                            <input id="playlistNameInput" class="field" placeholder="Nombre de la playlist" />
                            <textarea id="playlistDescriptionInput" class="textarea" rows="3" placeholder="Descripción de la playlist"></textarea>
                            <div class="cover-picker">
                                <div id="playlistCoverPreviewShell" class="cover-picker-preview-shell playlist-preview is-empty">
                                    <i class="fa-regular fa-image cover-picker-empty-icon"></i>
                                    <img id="playlistCoverPreview" class="cover-picker-preview" src="" alt="preview" />
                                </div>
                                <div class="cover-picker-meta">
                                    <div id="playlistCoverFileName" class="cover-file-name">Ninguna imagen seleccionada</div>
                                    <div class="flex items-center gap-2">
                                        <button class="btn ghost" type="button" onclick="triggerCoverFileSelect()">Seleccionar imagen</button>
                                        <button class="btn danger" type="button" onclick="resetCoverFileSelection()">Quitar</button>
                                    </div>
                                </div>
                                <input id="playlistCoverFileInput" class="hidden" type="file" accept="image/*" />
                            </div>
                            <button class="btn" type="button" onclick="createPlaylist()">Crear</button>
                        </div>
                    </div>

                    <div id="adminEditPanel" class="admin-box hidden" style="grid-column: 1 / -1;">
                        <div class="font-semibold mb-2">Editar playlist</div>
                        <div class="space-y-2">
                            <select id="editPlaylistSelect" class="select" onchange="onEditPlaylistSelectChange()"></select>
                            <input id="editPlaylistNameInput" class="field" placeholder="Nuevo título" />
                            <textarea id="editPlaylistDescriptionInput" class="textarea" rows="3" placeholder="Nueva descripción"></textarea>
                            <div class="cover-picker">
                                <div id="editPlaylistCoverPreviewShell" class="cover-picker-preview-shell playlist-preview is-empty">
                                    <i class="fa-regular fa-image cover-picker-empty-icon"></i>
                                    <img id="editPlaylistCoverPreview" class="cover-picker-preview" src="" alt="preview" />
                                </div>
                                <div class="cover-picker-meta">
                                    <div id="editPlaylistCoverFileName" class="cover-file-name">Mantener portada actual</div>
                                    <div class="flex items-center gap-2">
                                        <button class="btn ghost" type="button" onclick="triggerEditCoverFileSelect()">Cambiar portada</button>
                                        <button class="btn danger" type="button" onclick="resetEditCoverFileSelection()">Quitar cambio</button>
                                    </div>
                                </div>
                                <input id="editPlaylistCoverFileInput" class="hidden" type="file" accept="image/*" />
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="btn" type="button" onclick="updateSelectedPlaylist()">Guardar cambios</button>
                                <button class="btn danger" type="button" onclick="deleteSelectedPlaylist()">Eliminar playlist</button>
                            </div>
                        </div>
                    </div>

                    <div id="adminTrackPanel" class="admin-box hidden" style="grid-column: 1 / -1;">
                        <div class="font-semibold mb-2">Agregar canción MP3</div>
                        <div class="space-y-2">
                            <select id="trackPlaylistSelect" class="select"></select>
                            <input id="trackTitleInput" class="field" placeholder="Nombre de la canción" />
                            <input id="trackArtistInput" class="field" placeholder="Artista" />
                            <input id="trackAlbumInput" class="field" placeholder="Álbum" />

                            <div class="cover-picker">
                                <div id="trackCoverPreviewShell" class="cover-picker-preview-shell is-empty">
                                    <i class="fa-regular fa-image cover-picker-empty-icon"></i>
                                    <img id="trackCoverPreview" class="cover-picker-preview" src="" alt="preview" />
                                </div>
                                <div class="cover-picker-meta">
                                    <div id="trackCoverFileName" class="cover-file-name">Ninguna carátula seleccionada</div>
                                    <div class="flex items-center gap-2">
                                        <button class="btn ghost" type="button" onclick="triggerTrackCoverFileSelect()">Seleccionar carátula</button>
                                        <button class="btn danger" type="button" onclick="resetTrackCoverFileSelection()">Quitar</button>
                                    </div>
                                </div>
                                <input id="trackCoverFileInput" class="hidden" type="file" accept="image/*" />
                            </div>

                            <div class="cover-picker">
                                <div id="trackAudioPreviewShell" class="cover-picker-preview-shell is-empty">
                                    <i class="fa-solid fa-music cover-picker-empty-icon"></i>
                                    <img id="trackAudioPreview" class="cover-picker-preview" src="" alt="preview" />
                                </div>
                                <div class="cover-picker-meta">
                                    <div id="trackAudioFileName" class="cover-file-name">Ningún MP3 seleccionado</div>
                                    <div class="flex items-center gap-2">
                                        <button class="btn ghost" type="button" onclick="triggerTrackAudioFileSelect()">Seleccionar MP3</button>
                                        <button class="btn danger" type="button" onclick="resetTrackAudioFileSelection()">Quitar</button>
                                    </div>
                                </div>
                                <input id="trackAudioFileInput" class="hidden" type="file" accept="audio/mpeg,.mp3" />
                            </div>

                            <div class="flex items-center gap-2">
                                <button class="btn" type="button" onclick="createTrackFromUpload()">Agregar canción</button>
                            </div>
                            <div id="trackPreviewBox" class="muted"></div>
                        </div>

                        <div class="font-semibold mt-3 mb-2">Quitar canciones de playlist</div>
                        <div id="adminTrackList" class="admin-track-list"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="resize-handle" id="musicResizeHandle"></div>
</div>

<script>
    const MUSIC_USER_TYPE = @json($userType ?? 'guest');
    const MUSIC_IS_ADMIN = MUSIC_USER_TYPE === 'admin';
    const MUSIC_CSRF = @json(csrf_token());
    const MUSIC_MIN_WIDTH = 700;
    const MUSIC_MIN_HEIGHT = 420;

    let isMusicMaximized = false;
    let isMusicDragging = false;
    let isMusicResizing = false;
    let musicDragOffsetX = 0;
    let musicDragOffsetY = 0;
    let musicStartX = 0;
    let musicStartY = 0;
    let musicStartW = 0;
    let musicStartH = 0;

    let musicPlaylists = [];
    let activePlaylistId = null;
    let activeTrackId = null;
    let loadedTrackId = null;
    let isMusicSidebarCollapsed = false;
    let musicViewMode = 'home';
    let adminPanelTab = 'create';
    let editPlaylistId = null;
    let musicProgressTimer = null;
    let isShuffleEnabled = false;
    let isRepeatEnabled = false;
    let isDraggingProgress = false;

    const musicWindow = document.getElementById('musicWindow');
    const musicHeader = musicWindow.querySelector('.window-header');
    const musicResizeHandle = document.getElementById('musicResizeHandle');
    const musicAudioPlayer = document.getElementById('musicAudioPlayer');

    function sendMusicMessage(type, extra = {}) {
        const payload = { app: 'music', type, ...extra };
        if (window.parent && window.parent !== window) {
            window.parent.postMessage(payload, '*');
        } else {
            window.postMessage(payload, '*');
        }
    }

    function applyMusicSidebarState() {
        musicWindow.classList.toggle('sidebar-collapsed', isMusicSidebarCollapsed);
        const toggleBtn = document.getElementById('musicSidebarToggleBtn');
        if (!toggleBtn) return;

        toggleBtn.innerHTML = isMusicSidebarCollapsed
            ? '<i class="fa-solid fa-angles-right"></i>'
            : '<i class="fa-solid fa-angles-left"></i>';
        toggleBtn.title = isMusicSidebarCollapsed
            ? 'Expandir barra lateral'
            : 'Contraer barra lateral';
    }

    function toggleMusicSidebar() {
        isMusicSidebarCollapsed = !isMusicSidebarCollapsed;
        applyMusicSidebarState();
    }

    async function apiRequest(url, options = {}) {
        const isFormData = options.body instanceof FormData;
        const headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': MUSIC_CSRF,
            ...(options.headers || {}),
        };

        if (!isFormData && !headers['Content-Type']) {
            headers['Content-Type'] = 'application/json';
        }

        const response = await fetch(url, {
            headers,
            credentials: 'same-origin',
            ...options,
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data.message || 'No se pudo completar la operación.');
        }

        return data;
    }

    function getActivePlaylist() {
        return musicPlaylists.find(item => item.id === activePlaylistId) || null;
    }

    function getActiveTrack() {
        const playlist = getActivePlaylist();
        if (!playlist) return null;
        return (playlist.tracks || []).find(item => item.id === activeTrackId) || null;
    }

    function getActivePlaylistTracks() {
        return Array.isArray(getActivePlaylist()?.tracks) ? getActivePlaylist().tracks : [];
    }

    function getActiveTrackIndex() {
        const tracks = getActivePlaylistTracks();
        return tracks.findIndex(item => item.id === activeTrackId);
    }

    function formatSeconds(value) {
        const total = Math.max(0, Math.floor(Number(value) || 0));
        const mins = Math.floor(total / 60);
        const secs = total % 60;
        return `${mins}:${String(secs).padStart(2, '0')}`;
    }

    function updatePlayPauseButton(isPlaying) {
        const btn = document.getElementById('musicPlayPauseBtn');
        if (!btn) return;
        btn.innerHTML = isPlaying
            ? '<i class="fa-solid fa-pause"></i>'
            : '<i class="fa-solid fa-play"></i>';
    }

    function updateModeButtons() {
        document.getElementById('musicShuffleBtn')?.classList.toggle('active', isShuffleEnabled);
        document.getElementById('musicRepeatBtn')?.classList.toggle('active', isRepeatEnabled);
    }

    function resolveTrackCover(track) {
        if (!track) return 'https://via.placeholder.com/120x120.png?text=%E2%99%AA';
        return track.thumbnail_url || 'https://via.placeholder.com/120x120.png?text=%E2%99%AA';
    }

    function getEditPlaylist() {
        return musicPlaylists.find(item => item.id === editPlaylistId) || null;
    }

    function escapeHtml(value) {
        return String(value || '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#39;');
    }

    function setPreviewImage(previewId, source = '') {
        const preview = document.getElementById(previewId);
        if (!preview) return;

        const shell = preview.closest('.cover-picker-preview-shell');
        const value = String(source || '').trim();

        if (!value) {
            preview.removeAttribute('src');
            shell?.classList.add('is-empty');
            return;
        }

        preview.src = value;
        shell?.classList.remove('is-empty');

        preview.onerror = () => {
            preview.removeAttribute('src');
            shell?.classList.add('is-empty');
        };
    }

    function updateNowPlayingText(track) {
        const title = document.getElementById('musicNowTitle');
        const author = document.getElementById('musicNowAuthor');
        const thumb = document.getElementById('musicNowThumb');

        if (!title || !author || !thumb) return;

        if (!track) {
            title.textContent = 'Sin canción';
            author.textContent = 'Selecciona una canción para reproducir.';
            thumb.src = 'https://via.placeholder.com/120x120.png?text=%E2%99%AA';
            return;
        }

        thumb.src = resolveTrackCover(track);
        title.textContent = track.title || 'Sin título';
        author.textContent = track.artist || 'Autor desconocido';
    }

    function updateProgressUI() {
        const range = document.getElementById('musicProgressRange');
        const currentLabel = document.getElementById('musicCurrentTime');
        const durationLabel = document.getElementById('musicDurationTime');
        if (!range || !currentLabel || !durationLabel) return;

        const current = Number(musicAudioPlayer?.currentTime || 0);
        const duration = Number(musicAudioPlayer?.duration || 0);

        range.max = String(Math.max(0, Math.floor(duration)));
        if (!isDraggingProgress) {
            range.value = String(Math.max(0, Math.floor(current)));
        }

        currentLabel.textContent = formatSeconds(current);
        durationLabel.textContent = formatSeconds(duration);
    }

    function startProgressSync() {
        stopProgressSync();
        musicProgressTimer = window.setInterval(updateProgressUI, 400);
    }

    function stopProgressSync() {
        if (musicProgressTimer) {
            window.clearInterval(musicProgressTimer);
            musicProgressTimer = null;
        }
    }

    function applyPlayerVolume(volume) {
        const normalized = Math.max(0, Math.min(100, Number(volume) || 0));
        const slider = document.getElementById('musicVolumeRange');
        if (slider) slider.value = String(normalized);
        if (musicAudioPlayer) {
            musicAudioPlayer.volume = normalized / 100;
        }
    }

    function loadTrackIntoPlayer(track, autoplay = false) {
        if (!musicAudioPlayer || !track) return;

        const source = String(track.audio_url || '').trim();
        if (!source) {
            musicAudioPlayer.removeAttribute('src');
            musicAudioPlayer.load();
            return;
        }

        loadedTrackId = track.id;

        if (musicAudioPlayer.src !== source) {
            musicAudioPlayer.src = source;
            musicAudioPlayer.load();
        }

        if (autoplay) {
            musicAudioPlayer.play().catch(() => updatePlayPauseButton(false));
        } else {
            musicAudioPlayer.pause();
            updatePlayPauseButton(false);
        }

        updateProgressUI();
    }

    function playTrackById(trackId, autoplay = true) {
        const playlist = getActivePlaylist();
        if (!playlist) return;
        const track = (playlist.tracks || []).find(item => item.id === Number(trackId));
        if (!track) return;

        activeTrackId = track.id;
        renderTrackList();
        updateNowPlayingText(track);
        loadTrackIntoPlayer(track, autoplay);
    }

    function playNextTrackInPlaylist() {
        const tracks = getActivePlaylistTracks();
        const index = getActiveTrackIndex();
        if (index < 0 || tracks.length === 0) return;

        if (isShuffleEnabled && tracks.length > 1) {
            let randomIndex = index;
            while (randomIndex === index) {
                randomIndex = Math.floor(Math.random() * tracks.length);
            }
            playTrackById(tracks[randomIndex].id, true);
            return;
        }

        const nextTrack = tracks[index + 1];
        if (!nextTrack) {
            if (isRepeatEnabled) {
                playTrackById(tracks[0].id, true);
            }
            return;
        }
        playTrackById(nextTrack.id, true);
    }

    function playPreviousTrackInPlaylist() {
        const tracks = getActivePlaylistTracks();
        const index = getActiveTrackIndex();
        if (index < 0 || tracks.length === 0) return;

        if (isShuffleEnabled && tracks.length > 1) {
            let randomIndex = index;
            while (randomIndex === index) {
                randomIndex = Math.floor(Math.random() * tracks.length);
            }
            playTrackById(tracks[randomIndex].id, true);
            return;
        }

        const prevTrack = tracks[index - 1];
        if (!prevTrack) {
            if (isRepeatEnabled) {
                playTrackById(tracks[tracks.length - 1].id, true);
            }
            return;
        }
        playTrackById(prevTrack.id, true);
    }

    function toggleShuffleMode() {
        isShuffleEnabled = !isShuffleEnabled;
        updateModeButtons();
    }

    function toggleRepeatMode() {
        isRepeatEnabled = !isRepeatEnabled;
        updateModeButtons();
    }

    function togglePlayPause() {
        const track = getActiveTrack();
        if (!track || !musicAudioPlayer) return;

        if (!musicAudioPlayer.src) {
            playTrackById(track.id, true);
            return;
        }

        if (!musicAudioPlayer.paused) {
            musicAudioPlayer.pause();
            updatePlayPauseButton(false);
        } else {
            musicAudioPlayer.play().then(() => {
                updatePlayPauseButton(true);
            }).catch(() => {
                updatePlayPauseButton(false);
            });
        }
    }

    function onProgressRangeStartDrag() {
        isDraggingProgress = true;
    }

    function onProgressRangeInput(event) {
        const value = Number(event.target.value || 0);
        const currentLabel = document.getElementById('musicCurrentTime');
        if (currentLabel) currentLabel.textContent = formatSeconds(value);
    }

    function onProgressRangeChange(event) {
        const value = Number(event.target.value || 0);
        if (musicAudioPlayer) {
            musicAudioPlayer.currentTime = value;
        }
        isDraggingProgress = false;
        updateProgressUI();
    }

    function onProgressRangeEndDrag() {
        isDraggingProgress = false;
    }

    function onVolumeChange(event) {
        applyPlayerVolume(event.target.value);
    }

    function handleAudioPlay() {
        updatePlayPauseButton(true);
        startProgressSync();
    }

    function handleAudioPause() {
        updatePlayPauseButton(false);
        stopProgressSync();
        updateProgressUI();
    }

    function handleAudioEnded() {
        updatePlayPauseButton(false);
        stopProgressSync();
        playNextTrackInPlaylist();
    }

    function handleAudioMetadataLoaded() {
        updateProgressUI();
    }

    function clampColor(value) {
        return Math.max(0, Math.min(255, Math.round(value)));
    }

    function rgbToHex(r, g, b) {
        const toHex = (n) => clampColor(n).toString(16).padStart(2, '0');
        return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
    }

    function setHeroGradient(a, b, c) {
        musicWindow.style.setProperty('--music-hero-a', a);
        musicWindow.style.setProperty('--music-hero-b', b);
        musicWindow.style.setProperty('--music-hero-c', c);
    }

    function setDefaultHeroGradient() {
        const darkMode = document.body.classList.contains('dark-mode');
        if (darkMode) {
            setHeroGradient('#8a6647', '#583f2f', '#271a14');
        } else {
            setHeroGradient('#7d5f43', '#5b4331', '#35241b');
        }
    }

    function applyHeroGradientFromCover(url) {
        if (!url) {
            setDefaultHeroGradient();
            return;
        }

        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.referrerPolicy = 'no-referrer';
        img.onload = () => {
            try {
                const canvas = document.createElement('canvas');
                canvas.width = 36;
                canvas.height = 36;
                const ctx = canvas.getContext('2d', { willReadFrequently: true });
                if (!ctx) {
                    setDefaultHeroGradient();
                    return;
                }

                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                const pixels = ctx.getImageData(0, 0, canvas.width, canvas.height).data;

                let r = 0;
                let g = 0;
                let b = 0;
                let count = 0;

                for (let i = 0; i < pixels.length; i += 4) {
                    const alpha = pixels[i + 3];
                    if (alpha < 20) continue;
                    r += pixels[i];
                    g += pixels[i + 1];
                    b += pixels[i + 2];
                    count++;
                }

                if (count === 0) {
                    setDefaultHeroGradient();
                    return;
                }

                r /= count;
                g /= count;
                b /= count;

                const colorA = rgbToHex(r * 1.08, g * 1.03, b * 0.95);
                const colorB = rgbToHex(r * 0.74, g * 0.66, b * 0.6);
                const colorC = rgbToHex(r * 0.45, g * 0.38, b * 0.34);

                setHeroGradient(colorA, colorB, colorC);
            } catch (_) {
                setDefaultHeroGradient();
            }
        };

        img.onerror = () => setDefaultHeroGradient();
        img.src = url;
    }

    function setMusicViewMode(mode) {
        if (mode === 'admin' && !MUSIC_IS_ADMIN) return;
        musicViewMode = mode;

        document.getElementById('musicHomeSection')?.classList.toggle('hidden', mode !== 'home');
        document.getElementById('musicAdminSection')?.classList.toggle('hidden', mode !== 'admin');
        document.getElementById('musicHomeNavBtn')?.classList.toggle('active', mode === 'home');
        document.getElementById('musicAdminNavBtn')?.classList.toggle('active', mode === 'admin');

        if (mode === 'admin') {
            setAdminPanelTab(adminPanelTab);
        }
    }

    function setAdminPanelTab(tab) {
        if (!MUSIC_IS_ADMIN) return;

        const allowedTabs = ['create', 'edit', 'track'];
        adminPanelTab = allowedTabs.includes(tab) ? tab : 'create';

        document.getElementById('adminCreatePanel')?.classList.toggle('hidden', adminPanelTab !== 'create');
        document.getElementById('adminEditPanel')?.classList.toggle('hidden', adminPanelTab !== 'edit');
        document.getElementById('adminTrackPanel')?.classList.toggle('hidden', adminPanelTab !== 'track');

        document.getElementById('adminTabCreateBtn')?.classList.toggle('active', adminPanelTab === 'create');
        document.getElementById('adminTabEditBtn')?.classList.toggle('active', adminPanelTab === 'edit');
        document.getElementById('adminTabTrackBtn')?.classList.toggle('active', adminPanelTab === 'track');
    }

    async function loadMusicData() {
        try {
            const data = await apiRequest('/music/playlists', { method: 'GET' });
            musicPlaylists = Array.isArray(data.playlists) ? data.playlists : [];

            if (!musicPlaylists.some(item => item.id === activePlaylistId)) {
                activePlaylistId = musicPlaylists[0]?.id ?? null;
            }

            if (!musicPlaylists.some(item => item.id === editPlaylistId)) {
                editPlaylistId = activePlaylistId;
            }

            const tracks = getActivePlaylist()?.tracks || [];
            if (!tracks.some(item => item.id === activeTrackId)) {
                activeTrackId = tracks[0]?.id ?? null;
            }

            renderMusicUI();
        } catch (error) {
            alert(error.message);
        }
    }

    function renderMusicUI() {
        renderPlaylistList();
        renderHero();
        renderTrackList();
        renderNowPlaying();
        renderAdminState();
        renderPlaylistSelects();
        syncEditPlaylistForm();
        renderAdminTrackList();
        setMusicViewMode(musicViewMode);
    }

    function renderPlaylistList() {
        const list = document.getElementById('musicPlaylistList');
        const count = document.getElementById('musicPlaylistCount');
        const guestHint = document.getElementById('musicGuestHint');

        count.textContent = `${musicPlaylists.length}`;

        if (musicPlaylists.length === 0) {
            list.innerHTML = '<div class="muted">No hay playlists aún.</div>';
            guestHint.classList.toggle('hidden', MUSIC_IS_ADMIN);
            return;
        }

        list.innerHTML = musicPlaylists.map((playlist) => {
            const cover = playlist.cover_url || 'https://via.placeholder.com/300x300.png?text=Playlist';
            const isActive = playlist.id === activePlaylistId;
            const trackCount = Array.isArray(playlist.tracks) ? playlist.tracks.length : 0;
            return `
                <div class="playlist-item ${isActive ? 'active' : ''}" onclick="selectPlaylist(${playlist.id})">
                    <img class="playlist-cover" src="${escapeHtml(cover)}" alt="cover" />
                    <div class="min-w-0">
                        <div class="font-semibold truncate">${escapeHtml(playlist.name)}</div>
                        <div class="muted">${trackCount} canción${trackCount === 1 ? '' : 'es'}</div>
                    </div>
                </div>
            `;
        }).join('');

        guestHint.classList.toggle('hidden', MUSIC_IS_ADMIN);
    }

    function renderHero() {
        const playlist = getActivePlaylist();
        const heroCover = document.getElementById('musicHeroCover');
        const heroTitle = document.getElementById('musicHeroTitle');
        const heroSubtitle = document.getElementById('musicHeroSubtitle');

        if (!playlist) {
            heroCover.src = 'https://via.placeholder.com/300x300.png?text=Playlist';
            heroTitle.textContent = 'Sin playlist';
            heroSubtitle.textContent = 'Selecciona una playlist para ver sus canciones.';
            setDefaultHeroGradient();
            return;
        }

        const coverUrl = playlist.cover_url || 'https://via.placeholder.com/300x300.png?text=Playlist';
        heroCover.src = coverUrl;
        heroTitle.textContent = playlist.name;
        const count = (playlist.tracks || []).length;
        const desc = (playlist.description || '').trim();
        heroSubtitle.textContent = desc !== ''
            ? `${desc} · ${count} canción${count === 1 ? '' : 'es'}`
            : `${count} canción${count === 1 ? '' : 'es'} · Selecciona un tema para reproducir`;
        applyHeroGradientFromCover(coverUrl);
    }

    function renderTrackList() {
        const wrap = document.getElementById('musicTracksWrap');
        const playlist = getActivePlaylist();

        if (!playlist) {
            wrap.innerHTML = '<div class="muted">No hay playlist seleccionada.</div>';
            return;
        }

        const tracks = Array.isArray(playlist.tracks) ? playlist.tracks : [];
        if (tracks.length === 0) {
            wrap.innerHTML = '<div class="muted">Esta playlist aún no tiene canciones.</div>';
            return;
        }

        const head = `
            <div class="tracks-head">
                <div>#</div>
                <div></div>
                <div>Título</div>
                <div class="hide-sm">Álbum</div>
                <div class="hide-sm">Duración</div>
                <div></div>
                <div></div>
            </div>
        `;

        const rows = tracks.map((track, index) => {
            const thumb = resolveTrackCover(track);
            const active = track.id === activeTrackId;
            return `
                <div class="track-row ${active ? 'active' : ''}" onclick="selectTrack(${track.id})">
                    <div class="track-number">${index + 1}</div>
                    <img class="track-thumb" src="${escapeHtml(thumb)}" alt="thumb" />
                    <div class="min-w-0">
                        <div class="track-title truncate">${escapeHtml(track.title)}</div>
                        <div class="track-author truncate">${escapeHtml(track.artist || 'Autor desconocido')}</div>
                    </div>
                    <div class="track-album truncate hide-sm">${escapeHtml(track.album || 'Sin álbum')}</div>
                    <div class="track-duration hide-sm">${track.duration_seconds ? formatSeconds(track.duration_seconds) : '--:--'}</div>
                    <button class="btn ghost" style="padding:0.35rem 0.5rem;" onclick="event.stopPropagation(); playTrackById(${track.id}, true)"><i class="fa-solid fa-play"></i></button>
                    ${MUSIC_IS_ADMIN ? `<button class="btn danger" style="padding:0.35rem 0.5rem;" onclick="event.stopPropagation(); deleteTrack(${track.id})"><i class="fa-solid fa-trash"></i></button>` : '<div></div>'}
                </div>
            `;
        }).join('');

        wrap.innerHTML = head + rows;
    }

    function renderNowPlaying() {
        const track = getActiveTrack();

        if (!track) {
            loadedTrackId = null;
            if (musicAudioPlayer) {
                musicAudioPlayer.pause();
                musicAudioPlayer.removeAttribute('src');
                musicAudioPlayer.load();
            }
            updateNowPlayingText(null);
            updatePlayPauseButton(false);
            stopProgressSync();
            updateProgressUI();
            return;
        }

        updateNowPlayingText(track);
        if (loadedTrackId !== track.id) {
            loadTrackIntoPlayer(track, false);
        }
        updateProgressUI();
    }

    function playActiveTrack() {
        const track = getActiveTrack();
        if (!track) return;
        playTrackById(track.id, true);
    }

    function renderAdminState() {
        document.getElementById('musicGuestHint')?.classList.toggle('hidden', MUSIC_IS_ADMIN);
    }

    function renderPlaylistSelects() {
        const options = musicPlaylists
            .map(item => `<option value="${item.id}">${escapeHtml(item.name)}</option>`)
            .join('');

        const trackSelect = document.getElementById('trackPlaylistSelect');
        const editSelect = document.getElementById('editPlaylistSelect');

        if (trackSelect) {
            trackSelect.innerHTML = options || '<option value="">Sin playlists</option>';
            trackSelect.value = String(activePlaylistId || '');
        }

        if (editSelect) {
            editSelect.innerHTML = options || '<option value="">Sin playlists</option>';
            editSelect.value = String(editPlaylistId || '');
        }
    }

    function selectPlaylist(playlistId) {
        activePlaylistId = Number(playlistId);
        const tracks = getActivePlaylist()?.tracks || [];
        activeTrackId = tracks[0]?.id ?? null;
        if (!editPlaylistId) editPlaylistId = activePlaylistId;
        renderMusicUI();
    }

    function selectTrack(trackId) {
        activeTrackId = Number(trackId);
        renderTrackList();
        renderNowPlaying();
    }

    async function createPlaylist() {
        const nameInput = document.getElementById('playlistNameInput');
        const descriptionInput = document.getElementById('playlistDescriptionInput');
        const coverFileInput = document.getElementById('playlistCoverFileInput');
        const name = nameInput.value.trim();
        const description = descriptionInput.value.trim();
        const coverFile = coverFileInput.files?.[0] || null;

        if (!name) {
            alert('Ingresa un nombre para la playlist.');
            return;
        }

        try {
            let finalCoverUrl = null;
            if (coverFile) {
                const formData = new FormData();
                formData.append('cover', coverFile);
                const uploadResult = await apiRequest('/music/upload-cover', {
                    method: 'POST',
                    body: formData,
                });
                finalCoverUrl = uploadResult.cover_url || null;
            }

            await apiRequest('/music/playlists', {
                method: 'POST',
                body: JSON.stringify({
                    name,
                    description: description || null,
                    cover_url: finalCoverUrl,
                }),
            });

            nameInput.value = '';
            descriptionInput.value = '';
            resetCoverFileSelection();
            await loadMusicData();
        } catch (error) {
            alert(error.message);
        }
    }

    function onEditPlaylistSelectChange() {
        const select = document.getElementById('editPlaylistSelect');
        editPlaylistId = Number(select.value || 0) || null;
        syncEditPlaylistForm();
        renderAdminTrackList();
    }

    function syncEditPlaylistForm() {
        const playlist = getEditPlaylist();
        const nameInput = document.getElementById('editPlaylistNameInput');
        const descInput = document.getElementById('editPlaylistDescriptionInput');
        const preview = document.getElementById('editPlaylistCoverPreview');

        if (!nameInput || !descInput || !preview) return;

        if (!playlist) {
            nameInput.value = '';
            descInput.value = '';
            setPreviewImage('editPlaylistCoverPreview', '');
            return;
        }

        nameInput.value = playlist.name || '';
        descInput.value = playlist.description || '';
        setPreviewImage('editPlaylistCoverPreview', playlist.cover_url || '');
        resetEditCoverFileSelection(false);
    }

    async function updateSelectedPlaylist() {
        const playlist = getEditPlaylist();
        if (!playlist) {
            alert('Selecciona una playlist para editar.');
            return;
        }

        const name = document.getElementById('editPlaylistNameInput').value.trim();
        const description = document.getElementById('editPlaylistDescriptionInput').value.trim();
        const coverFile = document.getElementById('editPlaylistCoverFileInput').files?.[0] || null;

        if (!name) {
            alert('El título no puede quedar vacío.');
            return;
        }

        try {
            let coverUrl = playlist.cover_url || null;

            if (coverFile) {
                const formData = new FormData();
                formData.append('cover', coverFile);
                const uploadResult = await apiRequest('/music/upload-cover', {
                    method: 'POST',
                    body: formData,
                });
                coverUrl = uploadResult.cover_url || coverUrl;
            }

            await apiRequest(`/music/playlists/${playlist.id}`, {
                method: 'PUT',
                body: JSON.stringify({
                    name,
                    description: description || null,
                    cover_url: coverUrl,
                }),
            });

            await loadMusicData();
            alert('Playlist actualizada correctamente.');
        } catch (error) {
            alert(error.message);
        }
    }

    async function deleteSelectedPlaylist() {
        const playlist = getEditPlaylist();
        if (!playlist) {
            alert('Selecciona una playlist para eliminar.');
            return;
        }

        if (!confirm(`¿Eliminar la playlist "${playlist.name}" y todas sus canciones?`)) {
            return;
        }

        try {
            await apiRequest(`/music/playlists/${playlist.id}`, { method: 'DELETE' });
            if (activePlaylistId === playlist.id) activePlaylistId = null;
            if (editPlaylistId === playlist.id) editPlaylistId = null;
            await loadMusicData();
        } catch (error) {
            alert(error.message);
        }
    }

    function renderAdminTrackList() {
        const list = document.getElementById('adminTrackList');
        if (!list) return;
        const playlist = getEditPlaylist();

        if (!playlist) {
            list.innerHTML = '<div class="muted">Selecciona una playlist.</div>';
            return;
        }

        const tracks = Array.isArray(playlist.tracks) ? playlist.tracks : [];
        if (tracks.length === 0) {
            list.innerHTML = '<div class="muted">Esta playlist no tiene canciones.</div>';
            return;
        }

        list.innerHTML = tracks.map((track) => `
            <div class="admin-track-item">
                <div class="min-w-0">
                    <div class="font-semibold truncate">${escapeHtml(track.title)}</div>
                    <div class="muted truncate">${escapeHtml(track.artist || 'Autor desconocido')}</div>
                </div>
                <button class="btn danger" type="button" onclick="deleteTrack(${track.id})"><i class="fa-solid fa-trash"></i></button>
            </div>
        `).join('');
    }

    function triggerCoverFileSelect() {
        document.getElementById('playlistCoverFileInput')?.click();
    }

    function resetCoverFileSelection(resetPreview = true) {
        const input = document.getElementById('playlistCoverFileInput');
        const preview = document.getElementById('playlistCoverPreview');
        const fileName = document.getElementById('playlistCoverFileName');

        if (input) input.value = '';
        if (preview && resetPreview) setPreviewImage('playlistCoverPreview', '');
        if (fileName) fileName.textContent = 'Ninguna imagen seleccionada';
    }

    function handleCoverFileChange(event) {
        const file = event.target.files?.[0] || null;
        const preview = document.getElementById('playlistCoverPreview');
        const fileName = document.getElementById('playlistCoverFileName');

        if (!file) {
            resetCoverFileSelection();
            return;
        }

        if (fileName) fileName.textContent = file.name;
        const reader = new FileReader();
        reader.onload = () => {
            if (preview) setPreviewImage('playlistCoverPreview', String(reader.result || ''));
        };
        reader.readAsDataURL(file);
    }

    function triggerEditCoverFileSelect() {
        document.getElementById('editPlaylistCoverFileInput')?.click();
    }

    function resetEditCoverFileSelection(resetPreview = true) {
        const input = document.getElementById('editPlaylistCoverFileInput');
        const fileName = document.getElementById('editPlaylistCoverFileName');
        const preview = document.getElementById('editPlaylistCoverPreview');
        const playlist = getEditPlaylist();

        if (input) input.value = '';
        if (fileName) fileName.textContent = 'Mantener portada actual';

        if (resetPreview && preview) {
            setPreviewImage('editPlaylistCoverPreview', playlist?.cover_url || '');
        }
    }

    function handleEditCoverFileChange(event) {
        const file = event.target.files?.[0] || null;
        const preview = document.getElementById('editPlaylistCoverPreview');
        const fileName = document.getElementById('editPlaylistCoverFileName');

        if (!file) {
            resetEditCoverFileSelection();
            return;
        }

        if (fileName) fileName.textContent = file.name;
        const reader = new FileReader();
        reader.onload = () => {
            if (preview) setPreviewImage('editPlaylistCoverPreview', String(reader.result || ''));
        };
        reader.readAsDataURL(file);
    }

    function triggerTrackCoverFileSelect() {
        document.getElementById('trackCoverFileInput')?.click();
    }

    function triggerTrackAudioFileSelect() {
        document.getElementById('trackAudioFileInput')?.click();
    }

    function resetTrackCoverFileSelection() {
        const input = document.getElementById('trackCoverFileInput');
        const preview = document.getElementById('trackCoverPreview');
        const fileName = document.getElementById('trackCoverFileName');

        if (input) input.value = '';
        if (preview) setPreviewImage('trackCoverPreview', '');
        if (fileName) fileName.textContent = 'Ninguna carátula seleccionada';
    }

    function resetTrackAudioFileSelection() {
        const input = document.getElementById('trackAudioFileInput');
        const preview = document.getElementById('trackAudioPreview');
        const fileName = document.getElementById('trackAudioFileName');

        if (input) input.value = '';
        if (preview) setPreviewImage('trackAudioPreview', '');
        if (fileName) fileName.textContent = 'Ningún MP3 seleccionado';
    }

    function handleTrackCoverFileChange(event) {
        const file = event.target.files?.[0] || null;
        const preview = document.getElementById('trackCoverPreview');
        const fileName = document.getElementById('trackCoverFileName');

        if (!file) {
            resetTrackCoverFileSelection();
            return;
        }

        if (fileName) fileName.textContent = file.name;
        const reader = new FileReader();
        reader.onload = () => {
            if (preview) setPreviewImage('trackCoverPreview', String(reader.result || ''));
        };
        reader.readAsDataURL(file);
    }

    function handleTrackAudioFileChange(event) {
        const file = event.target.files?.[0] || null;
        const fileName = document.getElementById('trackAudioFileName');
        const preview = document.getElementById('trackAudioPreview');

        if (!file) {
            resetTrackAudioFileSelection();
            return;
        }

        if (fileName) fileName.textContent = file.name;
        if (preview) setPreviewImage('trackAudioPreview', 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="800" height="320"><rect width="100%" height="100%" fill="%23261e1d"/><text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="%23d8b88f" font-size="34" font-family="Arial">MP3 listo para subir</text></svg>');
    }

    async function createTrackFromUpload() {
        const select = document.getElementById('trackPlaylistSelect');
        const titleInput = document.getElementById('trackTitleInput');
        const artistInput = document.getElementById('trackArtistInput');
        const albumInput = document.getElementById('trackAlbumInput');
        const coverInput = document.getElementById('trackCoverFileInput');
        const audioInput = document.getElementById('trackAudioFileInput');
        const previewBox = document.getElementById('trackPreviewBox');

        const playlistId = Number(select.value || 0);
        const title = titleInput.value.trim();
        const artist = artistInput.value.trim();
        const album = albumInput.value.trim();
        const cover = coverInput.files?.[0] || null;
        const audio = audioInput.files?.[0] || null;

        if (!playlistId) {
            alert('Selecciona una playlist.');
            return;
        }

        if (!title || !artist || !album) {
            alert('Completa nombre de canción, artista y álbum.');
            return;
        }

        if (!audio) {
            alert('Selecciona un archivo MP3.');
            return;
        }

        if (!cover) {
            alert('Selecciona la carátula de la canción.');
            return;
        }

        try {
            const formData = new FormData();
            formData.append('music_playlist_id', String(playlistId));
            formData.append('title', title);
            formData.append('artist', artist);
            formData.append('album', album);
            formData.append('audio', audio);
            formData.append('cover', cover);

            await apiRequest('/music/tracks', {
                method: 'POST',
                body: formData,
            });

            titleInput.value = '';
            artistInput.value = '';
            albumInput.value = '';
            previewBox.innerHTML = '<span style="color:var(--music-success)">Canción agregada correctamente.</span>';
            resetTrackCoverFileSelection();
            resetTrackAudioFileSelection();

            activePlaylistId = playlistId;
            editPlaylistId = playlistId;
            await loadMusicData();
        } catch (error) {
            previewBox.innerHTML = `<span style="color:var(--music-danger)">${escapeHtml(error.message)}</span>`;
            alert(error.message);
        }
    }

    async function deleteTrack(trackId) {
        if (!confirm('¿Eliminar esta canción de la playlist?')) {
            return;
        }

        try {
            await apiRequest(`/music/tracks/${trackId}`, { method: 'DELETE' });
            await loadMusicData();
        } catch (error) {
            alert(error.message);
        }
    }

    function openMusicFloating() {
        isMusicMaximized = false;
        musicWindow.classList.remove('maximized');
        musicWindow.style.display = 'flex';
        musicWindow.style.position = 'fixed';
        musicWindow.style.width = '98vw';
        musicWindow.style.height = 'calc(100vh - 78px)';
        musicWindow.style.top = '8px';
        musicWindow.style.left = '50%';
        musicWindow.style.transform = 'translateX(-50%)';
        musicWindow.style.borderRadius = '1rem';
        musicWindow.style.resize = 'both';

        const btn = document.getElementById('musicMaxBtn');
        if (btn) btn.innerHTML = '<i class="fa-regular fa-square"></i>';
    }

    function openMusicMaximized() {
        isMusicMaximized = true;
        musicWindow.classList.add('maximized');
        musicWindow.style.display = 'flex';
        musicWindow.style.position = 'fixed';
        musicWindow.style.width = '100%';
        musicWindow.style.height = 'calc(100vh - 72px)';
        musicWindow.style.top = '0';
        musicWindow.style.left = '0';
        musicWindow.style.transform = 'none';
        musicWindow.style.borderRadius = '0';
        musicWindow.style.resize = 'none';

        const btn = document.getElementById('musicMaxBtn');
        if (btn) btn.innerHTML = '<i class="fa-regular fa-window-restore"></i>';
    }

    function clampMusicIntoViewport() {
        if (isMusicMaximized) return;

        const rect = musicWindow.getBoundingClientRect();
        let left = rect.left;
        let top = rect.top;
        const maxLeft = Math.max(0, window.innerWidth - rect.width);
        const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);

        left = Math.max(0, Math.min(left, maxLeft));
        top = Math.max(0, Math.min(top, maxTop));

        musicWindow.style.left = left + 'px';
        musicWindow.style.top = top + 'px';
        musicWindow.style.transform = 'none';
    }

    function minimizeMusic() {
        sendMusicMessage('focus');
        sendMusicMessage('minimize', { mode: isMusicMaximized ? 'maximized' : 'floating' });
    }

    function toggleMaximizeMusic() {
        sendMusicMessage('focus');
        isMusicMaximized = !isMusicMaximized;
        if (isMusicMaximized) {
            openMusicMaximized();
            sendMusicMessage('maximize');
        } else {
            openMusicFloating();
            sendMusicMessage('restore');
        }
    }

    function closeMusic() {
        sendMusicMessage('focus');
        sendMusicMessage('close');
    }

    window.addEventListener('message', (event) => {
        if (!event.data || !event.data.type) return;
        if (event.data.app && event.data.app !== 'music') return;

        if (event.data.type === 'openFloating') {
            openMusicFloating();
        } else if (event.data.type === 'openMaximized') {
            openMusicMaximized();
        }
    });

    musicHeader.addEventListener('mousedown', (event) => {
        if (event.target.closest('.window-controls') || isMusicMaximized) return;
        isMusicDragging = true;
        sendMusicMessage('focus');
        const rect = musicWindow.getBoundingClientRect();
        musicDragOffsetX = event.clientX - rect.left;
        musicDragOffsetY = event.clientY - rect.top;
    });

    musicResizeHandle.addEventListener('mousedown', (event) => {
        event.stopPropagation();
        if (isMusicMaximized) return;
        isMusicResizing = true;
        sendMusicMessage('focus');
        const rect = musicWindow.getBoundingClientRect();
        musicStartX = event.clientX;
        musicStartY = event.clientY;
        musicStartW = rect.width;
        musicStartH = rect.height;
    });

    document.addEventListener('mousemove', (event) => {
        if (isMusicDragging && !isMusicMaximized) {
            const rect = musicWindow.getBoundingClientRect();
            const maxLeft = Math.max(0, window.innerWidth - rect.width);
            const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);
            const left = Math.max(0, Math.min(event.clientX - musicDragOffsetX, maxLeft));
            const top = Math.max(0, Math.min(event.clientY - musicDragOffsetY, maxTop));
            musicWindow.style.left = left + 'px';
            musicWindow.style.top = top + 'px';
            musicWindow.style.transform = 'none';
        }

        if (isMusicResizing && !isMusicMaximized) {
            const rect = musicWindow.getBoundingClientRect();
            const maxWidth = Math.max(MUSIC_MIN_WIDTH, window.innerWidth - rect.left);
            const maxHeight = Math.max(MUSIC_MIN_HEIGHT, (window.innerHeight - 72) - rect.top);
            const width = Math.min(maxWidth, Math.max(MUSIC_MIN_WIDTH, musicStartW + (event.clientX - musicStartX)));
            const height = Math.min(maxHeight, Math.max(MUSIC_MIN_HEIGHT, musicStartH + (event.clientY - musicStartY)));
            musicWindow.style.width = width + 'px';
            musicWindow.style.height = height + 'px';
        }
    });

    document.addEventListener('mouseup', () => {
        isMusicDragging = false;
        isMusicResizing = false;
    });

    musicWindow.addEventListener('mousedown', () => sendMusicMessage('focus'));
    window.addEventListener('resize', clampMusicIntoViewport);

    (async function bootstrapMusic() {
        openMusicFloating();
        setMusicViewMode('home');
        setAdminPanelTab('create');
        applyMusicSidebarState();

        document.getElementById('musicProgressRange')?.addEventListener('mousedown', onProgressRangeStartDrag);
        document.getElementById('musicProgressRange')?.addEventListener('touchstart', onProgressRangeStartDrag, { passive: true });
        document.getElementById('musicProgressRange')?.addEventListener('input', onProgressRangeInput);
        document.getElementById('musicProgressRange')?.addEventListener('change', onProgressRangeChange);
        document.addEventListener('mouseup', onProgressRangeEndDrag);
        document.addEventListener('touchend', onProgressRangeEndDrag, { passive: true });
        document.getElementById('musicVolumeRange')?.addEventListener('input', onVolumeChange);

        document.getElementById('playlistCoverFileInput')?.addEventListener('change', handleCoverFileChange);
        document.getElementById('editPlaylistCoverFileInput')?.addEventListener('change', handleEditCoverFileChange);
        document.getElementById('trackCoverFileInput')?.addEventListener('change', handleTrackCoverFileChange);
        document.getElementById('trackAudioFileInput')?.addEventListener('change', handleTrackAudioFileChange);

        musicAudioPlayer?.addEventListener('play', handleAudioPlay);
        musicAudioPlayer?.addEventListener('pause', handleAudioPause);
        musicAudioPlayer?.addEventListener('ended', handleAudioEnded);
        musicAudioPlayer?.addEventListener('loadedmetadata', handleAudioMetadataLoaded);

        resetCoverFileSelection();
        resetEditCoverFileSelection();
        resetTrackCoverFileSelection();
        resetTrackAudioFileSelection();
        updatePlayPauseButton(false);
        updateModeButtons();
        updateProgressUI();
        applyPlayerVolume(document.getElementById('musicVolumeRange')?.value ?? 70);
        await loadMusicData();
    })();

    window.MusicApp = {
        openFloating: openMusicFloating,
        openMaximized: openMusicMaximized,
    };
</script>
