<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>

            .concert-one-regular {
                font-family: "Concert One", sans-serif;
                font-weight: 400;
                font-style: normal;
            }
            
            .roboto-condensed{
                font-family: "Roboto Condensed", sans-serif;
                font-optical-sizing: auto;
                font-weight: <weight>;
                font-style: normal;
            }

            body {
                font-family: 'Roboto Condensed', sans-serif;
                height: 100dvh;
                overflow: hidden;
            }

            @keyframes menuSlideUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .dashboard-bg {
                background: #443C3D;
                background-size: cover;
                background-position: center;
            }

            body.dark-mode.dashboard-bg {
                background: #1C1819;
            }

            .sidebar-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
                color: white;
                cursor: pointer;
                transition: transform 0.2s;
            }

            .sidebar-item:hover {
                transform: scale(1.1);
            }

            .sidebar-item i {
                font-size: 1.5rem;
            }

            .sidebar-item span {
                font-size: 0.75rem;
                text-align: center;
            }

            .bottom-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: rgba(40, 40, 40, 0.85);
                padding: 1rem 2rem;
                color: white;
                position: relative;
                z-index: 1200;
            }

            .taskbar-left {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .taskbar-separator {
                width: 1px;
                height: 26px;
                background-color: rgba(255, 255, 255, 0.2);
            }

            .taskbar-tab {
                display: none;
                align-items: center;
                gap: 0.6rem;
                background-color: rgba(181, 155, 121, 0.18);
                border: 2px solid rgba(181, 155, 121, 0.85);
                border-radius: 0.9rem;
                padding: 0.45rem 1rem;
                color: #E2D8CC;
                cursor: pointer;
                font-weight: 600;
            }

            .taskbar-tab.active {
                display: inline-flex;
            }

            .taskbar-tab.current {
                border-color: rgba(181, 155, 121, 1);
                background-color: rgba(181, 155, 121, 0.34);
                box-shadow: inset 0 0 0 1px rgba(226, 216, 204, 0.18);
            }

            .mobile-start-apps {
                display: none;
                margin-top: 0.35rem;
                border-top: 1px solid rgba(255, 255, 255, 0.12);
                padding-top: 0.35rem;
            }

            .mobile-start-apps.active {
                display: block;
            }

            .mobile-start-title {
                font-size: 0.72rem;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                color: #443C3D;
                padding: 0.45rem 1rem 0.35rem;
            }

            .mobile-start-empty {
                color: #443C3D;
                font-size: 0.86rem;
                padding: 0.55rem 1rem 0.8rem;
            }

            .mobile-start-apps .menu-item {
                width: 100%;
            }

            .taskbar-tab.social {
                background-color: rgba(196, 184, 168, 0.22);
            }

            .taskbar-tab.library {
                background-color: rgba(208, 196, 180, 0.25);
            }

            .taskbar-tab.files {
                background-color: rgba(190, 176, 160, 0.26);
            }

            .taskbar-tab.music {
                background-color: rgba(181, 155, 121, 0.24);
            }

            .user-badge {
                background-color: rgba(181, 155, 121, 0.4);
                border: 1px solid rgba(181, 155, 121, 0.8);
                font-family: 'Concert One', sans-serif;
                padding: 0.5rem 1rem;
                border-radius: 2rem;
                font-size: 0.85rem;
                display: inline-flex;
                gap: 0.5rem;
                align-items: center;
            }

            .user-badge::before {
                content: '';
                width: 8px;
                height: 8px;
                background-color: #b59b79;
                border-radius: 50%;
            }

            .chat-icon {
                position: fixed;
                top: 2rem;
                right: 2rem;
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .chat-icon:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

            .chat-icon i {
                font-size: 1.25rem;
                color: white;
            }

            .theme-toggle-icon {
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background-color 0.2s;
                flex-shrink: 0;
            }

            .theme-toggle-icon:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

            .theme-toggle-icon i {
                font-size: 1.35rem;
                color: white;
            }

            body.dark-mode .theme-toggle-icon {
                background-color: #272022;
            }

            body.dark-mode .bottom-bar {
                background-color: #1C1819;
            }

            body.dark-mode .menu-popup {
                background-color: #272022;
            }

            body.dark-mode .menu-header {
                background-color: #1C1819;
                color: #E2D8CC;
                border-bottom-color: #B59B79;
            }

            body.dark-mode .menu-item{
                color: #E2D8CC;
                border-bottom-color: #B59B79;
            }

            body.dark-mode .mobile-start-title {
                color: #E2D8CC;
                border-bottom-color: #B59B79;
            }

            body.dark-mode .mobile-start-empty {
                color: #E2D8CC;
                border-bottom-color: #B59B79;
            }

            body.dark-mode .menu-item:hover{
                background-color: #443C3D;
                color: #E2D8CC;
            }
            body.dark-mode .mobile-start-title:hover {
                background-color: #443C3D;
                color: #E2D8CC;
            }

            body.dark-mode #editorModal .text-editor-window,
            body.dark-mode #socialModal .app-window,
            body.dark-mode #libraryModal .library-window,
            body.dark-mode #filesModal .files-window {
                background: #1C1819 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #editorModal .editor-header,
            body.dark-mode #socialModal .window-header,
            body.dark-mode #libraryModal .window-header,
            body.dark-mode #filesModal .window-header {
                background: #B59B79 !important;
                color: #1C1819 !important;
                border-bottom: 1px solid #B59B79 !important;
            }

            body.dark-mode #editorModal .editor-btn,
            body.dark-mode #socialModal .window-btn,
            body.dark-mode #libraryModal .window-btn,
            body.dark-mode #filesModal .window-btn {
                color: #1C1819 !important;
            }

            body.dark-mode #editorModal .editor-toolbar,
            body.dark-mode #editorModal .te-bottom-bar,
            body.dark-mode #socialModal .left-menu,
            body.dark-mode #socialModal .post-actions,
            body.dark-mode #socialModal .tabs,
            body.dark-mode #libraryModal .library-toolbar,
            body.dark-mode #filesModal .top-bar,
            body.dark-mode #filesModal .folder-files-list,
            body.dark-mode #filesModal .remove-file-list {
                background: #1C1819 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #socialModal .card,
            body.dark-mode #socialModal .profile-row,
            body.dark-mode #socialModal .comment-item,
            body.dark-mode #libraryModal .card-block,
            body.dark-mode #libraryModal .chapter-item,
            body.dark-mode #libraryModal .progress-box,
            body.dark-mode #libraryModal .reader-caps,
            body.dark-mode #filesModal .folder-card,
            body.dark-mode #filesModal .file-row,
            body.dark-mode #editorModal .save-modal,
            body.dark-mode #editorModal .drafts-modal,
            body.dark-mode #editorModal .draft-item,
            body.dark-mode #socialModal .modal-box,
            body.dark-mode #libraryModal .modal-box,
            body.dark-mode #filesModal .modal-box {
                background: #272022 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #socialModal .primary-btn,
            body.dark-mode #socialModal .ghost-btn,
            body.dark-mode #socialModal .danger-btn,
            body.dark-mode #libraryModal .primary-btn,
            body.dark-mode #libraryModal .ghost-btn,
            body.dark-mode #libraryModal .danger-btn,
            body.dark-mode #libraryModal .chapter-edit-btn,
            body.dark-mode #libraryModal .reader-nav-btn,
            body.dark-mode #filesModal .primary-btn,
            body.dark-mode #filesModal .ghost-btn,
            body.dark-mode #filesModal .danger-btn,
            body.dark-mode #filesModal .danger-soft-btn,
            body.dark-mode #editorModal .notes-btn,
            body.dark-mode #editorModal .new-btn,
            body.dark-mode #editorModal .save-btn,
            body.dark-mode #editorModal .save-cancel-btn,
            body.dark-mode #editorModal .save-confirm-btn,
            body.dark-mode #editorModal .draft-action-btn {
                background: #272022 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #socialModal .post-action-btn,
            body.dark-mode #editorModal .toolbar-btn,
            body.dark-mode #editorModal .save-segmented-btn,
            body.dark-mode #editorModal .save-close-btn,
            body.dark-mode #filesModal .icon-btn,
            body.dark-mode #filesModal .badge {
                background: #272022 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #socialModal .input,
            body.dark-mode #socialModal .textarea,
            body.dark-mode #socialModal .select,
            body.dark-mode #libraryModal .input,
            body.dark-mode #libraryModal .textarea,
            body.dark-mode #libraryModal .select,
            body.dark-mode #filesModal .input,
            body.dark-mode #filesModal .search-input,
            body.dark-mode #filesModal .select,
            body.dark-mode #editorModal .save-input,
            body.dark-mode #editorModal .editor-rich {
                background: #272022 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode .taskbar-tab.current,
            body.dark-mode #socialModal .menu-item.active,
            body.dark-mode #socialModal .tabs button.active,
            body.dark-mode #libraryModal .reader-cap-btn.active,
            body.dark-mode #filesModal .folder-card:hover {
                background: #B59B79 !important;
                color: #1C1819 !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #socialModal .muted,
            body.dark-mode #libraryModal .muted,
            body.dark-mode #filesModal .muted,
            body.dark-mode #editorModal .save-muted {
                color: #E2D8CC !important;
                opacity: 0.8;
            }

            .menu-popup {
                position: fixed;
                bottom: 80px;
                left: 2rem;
                background-color: #E2D8CC;
                border-radius: 1rem;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                min-width: 220px;
                display: none;
                flex-direction: column;
                z-index: 1000;
            }

            .menu-popup.active {
                display: flex;
                animation: menuSlideUp 0.3s ease-out;
            }

            .menu-header {
                padding: 1rem;
                border-bottom: 1px solid #d0c4b4;
                color: #d0c4b4;
                background-color: #443C3D;
                font-weight: 700;
            }

            .menu-item {
                padding: 1rem;
                color: #443C3D;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                border-bottom: 1px solid #d0c4b4;
                transition: background-color 0.2s;
            }

            .menu-item:last-child {
                border-bottom: none;
            }

            .menu-item:hover {
                background-color: #d0c4b4;
                border-radius: 0.5rem;
            }

            .menu-item i {
                width: 20px;
                height: 20px;
            }

            .rest-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 999;
                cursor: pointer;
            }

            .rest-overlay.active {
                display: flex;
            }

            .rest-content {
                text-align: center;
                color: rgba(255, 255, 255, 0.6);
            }

            .floating-app {
                position: fixed;
                display: none;
                top: 0;
                left: 0;
                width: 100%;
                height: calc(100dvh - 72px);
                background: transparent;
                z-index: 1000;
                pointer-events: none;
            }

            .music-mini {
                position: fixed;
                right: 1.4rem;
                bottom: 5rem;
                width: min(460px, calc(100vw - 2rem));
                border-top: 1px solid rgba(255, 255, 255, 0.12);
                background: linear-gradient(180deg, #4a2f24 0%, #3a231b 100%);
                border-radius: 0.85rem;
                color: #f8f9fb;
                display: none;
                align-items: center;
                gap: 0.75rem;
                padding: 0.55rem 0.8rem;
                z-index: 1300;
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.45);
            }

            .music-mini.visible {
                display: flex;
            }

            .music-mini-cover {
                width: 44px;
                height: 44px;
                border-radius: 0.35rem;
                object-fit: cover;
                border: 1px solid rgba(255, 255, 255, 0.18);
                background: #6b4a3e;
                flex-shrink: 0;
            }

            .music-mini-meta {
                min-width: 0;
                flex: 1;
            }

            .music-mini-title {
                color: #fff;
                font-size: 0.76rem;
                font-weight: 700;
                line-height: 1.2;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .music-mini-author {
                color: #d8c3b5;
                font-size: 0.64rem;
                margin-top: 0.08rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .music-mini-controls {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 0.35rem;
            }

            .music-mini-btn {
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

            .music-mini-btn.primary {
                width: 34px;
                height: 34px;
                background: radial-gradient(circle at 30% 30%, #b07a60 0%, #8a5f49 72%, #6f4938 100%);
                border-color: rgba(255, 255, 255, 0.28);
            }

            .music-mini-btn.close {
                width: 28px;
                height: 28px;
                border-radius: 0.45rem;
                background: rgba(255, 255, 255, 0.12);
            }

            .music-mini-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.32), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            }

            body.dark-mode .music-mini {
                background: linear-gradient(180deg, #251813 0%, #17100d 100%);
                border-top-color: rgba(255, 255, 255, 0.1);
            }

            body.dark-mode .music-mini-author {
                color: #f0dfd4;
            }

            body.dark-mode .music-mini-btn {
                background: radial-gradient(circle at 30% 30%, #5a3d31 0%, #3f2a21 68%, #2e1f18 100%);
                border-color: rgba(255, 255, 255, 0.16);
            }

            body.dark-mode .music-mini-btn.primary {
                background: radial-gradient(circle at 30% 30%, #7f5a47 0%, #5d3f31 72%, #462e24 100%);
            }

            @media (max-width: 768px) {
                .taskbar-tab,
                .taskbar-separator {
                    display: none !important;
                }

                .dashboard-bg {
                    min-height: 100dvh;
                    height: auto;
                }

                .bottom-bar {
                    position: fixed;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    padding: 0.75rem 1rem;
                    padding-bottom: calc(0.75rem + env(safe-area-inset-bottom));
                    z-index: 2400;
                }

                .dashboard-main {
                    padding-bottom: 5.5rem;
                }

                .floating-app .text-editor-window,
                .floating-app .app-window,
                .floating-app .library-window,
                .floating-app .files-window,
                .floating-app .music-app-window {
                    width: 100vw !important;
                    max-width: 100vw !important;
                    min-width: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    transform: none !important;
                    border-radius: 0 !important;
                }
            }

        </style>
    </head>
    <body class="dashboard-bg h-screen flex flex-col">
        <!-- Chat Icon (Top Right) -->
        <div class="chat-icon">
            <i class="fas fa-comments"></i>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex dashboard-main">
            <!-- Left Sidebar -->
            <div class="w-24 pt-8 pb-32 px-4 flex flex-col gap-12">
                <!-- Editor de Texto - Solo para Admin -->
                @if($userType === 'admin')
                <div class="sidebar-item" onclick="openTextEditor()">
                    <i class="fas fa-file"></i>
                    <span>Editor de<br/>Texto</span>
                </div>
                @endif

                <!-- Red Social -->
                <div class="sidebar-item" onclick="openSocialWindow()">
                    <i class="fas fa-user-group"></i>
                    <span>Red<br/>Social</span>
                </div>

                <!-- Biblioteca -->
                <div class="sidebar-item" onclick="openBibliotecaWindow()">
                    <i class="fas fa-book"></i>
                    <span>Biblioteca</span>
                </div>

                <!-- Archivos -->
                <div class="sidebar-item" onclick="openFilesWindow()">
                    <i class="fas fa-folder"></i>
                    <span>Archivos</span>
                </div>
            </div>

            <!-- Center Content - Mostly Empty -->
            <div class="flex-1"></div>

            <!-- Right Sidebar -->
            <div class="w-24 pt-8 pb-32 px-4 flex flex-col gap-12 items-center">
                @if($userType === 'admin')
                <div class="sidebar-item fixed right-4 bottom-24 z-50" onclick="openMusicWindow()">
                    <i class="fas fa-music"></i>
                    <span>Música</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bottom-bar">
            <div class="taskbar-left">
                <div class="flex items-center gap-2 cursor-pointer" id="menuBtn" onclick="toggleMenu()">
                    <i class="fas fa-bars"></i>
                    <span>Inicio</span>
                </div>
                <div class="taskbar-separator"></div>
                <div id="editorBottomTab" class="taskbar-tab" onclick="restoreEditorFromTaskbar()">
                    <i class="fas fa-file-alt"></i>
                    <span>Editor de Texto</span>
                </div>
                <div id="socialBottomTab" class="taskbar-tab social" onclick="restoreSocialFromTaskbar()">
                    <i class="fas fa-user-group"></i>
                    <span>Red Social</span>
                </div>
                <div id="libraryBottomTab" class="taskbar-tab library" onclick="restoreLibraryFromTaskbar()">
                    <i class="fas fa-book"></i>
                    <span>Biblioteca</span>
                </div>
                <div id="filesBottomTab" class="taskbar-tab files" onclick="restoreFilesFromTaskbar()">
                    <i class="fas fa-folder"></i>
                    <span>Archivos</span>
                </div>
                @if($userType === 'admin')
                <div id="musicBottomTab" class="taskbar-tab music" onclick="restoreMusicFromTaskbar()">
                    <i class="fas fa-music"></i>
                    <span>Música</span>
                </div>
                @endif
            </div>

            <!-- Menu Popup -->
            <div class="menu-popup" id="menuPopup">
                <div class="menu-header">Menú de Inicio</div>
                <div class="menu-item" onclick="toggleRest()">
                    <i class="fas fa-moon"></i>
                    <span>Descanso</span>
                </div>
                <div class="menu-item" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </div>
                <div id="mobileStartApps" class="mobile-start-apps"></div>
            </div>

            <div class="flex items-center gap-4">
                <div class="user-badge">
                    {{ strtoupper($userType) }}
                </div>
                <div class="text-sm" id="timeDisplay">
                    <div id="timeHour">00:00</div>
                    <div id="timeDate">00 Mon</div>
                </div>
                <div class="theme-toggle-icon" onclick="toggleDarkMode()" title="Modo oscuro">
                    <i id="themeToggleIcon" class="fa-solid fa-moon"></i>
                </div>
            </div>
        </div>

        <!-- Rest Overlay -->
        <div class="rest-overlay" id="restOverlay" onclick="toggleRest()">
            <div class="rest-content">
                <img src="/storage/photo/NABBLOGO_BLANCO.png" alt="You need to wake up..." class="w-30 h-32 opacity-20 mx-auto mb-4">
                <p>Haz clic en cualquier parte para despertar</p>
            </div>
        </div>

        <!-- Text Editor Modal -->
        <div id="editorModal" class="floating-app" style="z-index: 1002;">
            @include('partials.textEditorApp')
        </div>

        <div id="socialModal" class="floating-app" style="z-index: 1001;">
            @include('partials.redSocialApp', ['userType' => $userType])
        </div>

        <div id="libraryModal" class="floating-app" style="z-index: 1000;">
            @include('partials.biblioteca', ['userType' => $userType])
        </div>

        <div id="filesModal" class="floating-app" style="z-index: 999;">
            @include('partials.archivos', ['userType' => $userType])
        </div>

        @if($userType === 'admin')
            <div id="musicModal" class="floating-app" style="z-index: 998;">
                @include('partials.music', ['userType' => $userType])
            </div>

            <div id="musicMiniPlayer" class="music-mini" onclick="restoreMusicFromMini(event)">
                <img id="musicMiniCover" class="music-mini-cover" src="/storage/photo/NABBLOGO_BLANCO.png" alt="cover">
                <div class="music-mini-meta">
                    <div id="musicMiniTitle" class="music-mini-title">No hay canción seleccionada</div>
                    <div id="musicMiniAuthor" class="music-mini-author">Selecciona una canción para reproducir.</div>
                </div>
                <div class="music-mini-controls">
                    <button class="music-mini-btn" type="button" onclick="miniMusicControl('prev', event)" title="Anterior"><i class="fa-solid fa-backward-step"></i></button>
                    <button id="musicMiniPlayBtn" class="music-mini-btn primary" type="button" onclick="miniMusicControl('playPause', event)" title="Reproducir / Pausar"><i class="fa-solid fa-play"></i></button>
                    <button class="music-mini-btn" type="button" onclick="miniMusicControl('next', event)" title="Siguiente"><i class="fa-solid fa-forward-step"></i></button>
                    <button class="music-mini-btn close" type="button" onclick="event.stopPropagation(); closeMusicWindow()" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        @endif

        <script>
            const DASHBOARD_THEME_KEY = 'dashboard_theme_v1';
            const MUSIC_ENABLED = @json($userType === 'admin');

            function applyDashboardTheme(mode) {
                const isDark = mode === 'dark';
                document.body.classList.toggle('dark-mode', isDark);

                const icon = document.getElementById('themeToggleIcon');
                if (icon) {
                    icon.classList.remove('fa-moon', 'fa-sun');
                    icon.classList.add(isDark ? 'fa-sun' : 'fa-moon');
                }
            }

            function toggleDarkMode() {
                const isDark = document.body.classList.contains('dark-mode');
                const nextMode = isDark ? 'light' : 'dark';
                applyDashboardTheme(nextMode);
                localStorage.setItem(DASHBOARD_THEME_KEY, nextMode);
            }

            function initDashboardTheme() {
                const saved = localStorage.getItem(DASHBOARD_THEME_KEY);
                applyDashboardTheme(saved === 'dark' ? 'dark' : 'light');
            }

            function setCurrentTab(app) {
                const editorBottomTab = document.getElementById('editorBottomTab');
                const socialBottomTab = document.getElementById('socialBottomTab');
                const libraryBottomTab = document.getElementById('libraryBottomTab');
                const filesBottomTab = document.getElementById('filesBottomTab');
                const musicBottomTab = document.getElementById('musicBottomTab');
                editorBottomTab?.classList.remove('current');
                socialBottomTab?.classList.remove('current');
                libraryBottomTab?.classList.remove('current');
                filesBottomTab?.classList.remove('current');
                musicBottomTab?.classList.remove('current');

                if (app === 'editor' && editorBottomTab?.classList.contains('active')) {
                    editorBottomTab.classList.add('current');
                }
                if (app === 'social' && socialBottomTab?.classList.contains('active')) {
                    socialBottomTab.classList.add('current');
                }
                if (app === 'library' && libraryBottomTab?.classList.contains('active')) {
                    libraryBottomTab.classList.add('current');
                }
                if (app === 'files' && filesBottomTab?.classList.contains('active')) {
                    filesBottomTab.classList.add('current');
                }
                if (MUSIC_ENABLED && app === 'music' && musicBottomTab?.classList.contains('active')) {
                    musicBottomTab.classList.add('current');
                }
            }

            function setFallbackCurrentTab() {
                const editorModal = document.getElementById('editorModal');
                const socialModal = document.getElementById('socialModal');
                const libraryModal = document.getElementById('libraryModal');
                const filesModal = document.getElementById('filesModal');
                const musicModal = document.getElementById('musicModal');
                const editorVisible = isModalVisible(editorModal);
                const socialVisible = isModalVisible(socialModal);
                const libraryVisible = isModalVisible(libraryModal);
                const filesVisible = isModalVisible(filesModal);
                const musicVisible = isModalVisible(musicModal);

                const visible = [];
                if (editorVisible) visible.push({ app: 'editor', id: 'editorModal', z: Number(editorModal.style.zIndex || 0) });
                if (socialVisible) visible.push({ app: 'social', id: 'socialModal', z: Number(socialModal.style.zIndex || 0) });
                if (libraryVisible) visible.push({ app: 'library', id: 'libraryModal', z: Number(libraryModal.style.zIndex || 0) });
                if (filesVisible) visible.push({ app: 'files', id: 'filesModal', z: Number(filesModal.style.zIndex || 0) });
                if (MUSIC_ENABLED && musicVisible) visible.push({ app: 'music', id: 'musicModal', z: Number(musicModal.style.zIndex || 0) });

                if (visible.length === 0) {
                    setCurrentTab('none');
                    return;
                }

                visible.sort((a, b) => b.z - a.z);
                setCurrentTab(visible[0].app);
                bringToFront(visible[0].id);
            }

            function bringToFront(modalId) {
                const editorModal = document.getElementById('editorModal');
                const socialModal = document.getElementById('socialModal');
                const libraryModal = document.getElementById('libraryModal');
                const filesModal = document.getElementById('filesModal');
                const musicModal = document.getElementById('musicModal');
                const modals = [editorModal, socialModal, libraryModal, filesModal, musicModal];

                const visibleOthers = modals
                    .filter(modal => modal && modal.id !== modalId && isModalVisible(modal))
                    .sort((a, b) => Number(a.style.zIndex || 0) - Number(b.style.zIndex || 0));

                let z = 1000;
                visibleOthers.forEach(modal => {
                    modal.style.zIndex = String(z);
                    z += 1;
                });

                const activeModal = document.getElementById(modalId);
                if (activeModal) {
                    activeModal.style.zIndex = String(z + 1);
                }
            }

            function setupFloatingWindowFocus() {
                const mapping = [
                    { id: 'editorModal', app: 'editor' },
                    { id: 'socialModal', app: 'social' },
                    { id: 'libraryModal', app: 'library' },
                    { id: 'filesModal', app: 'files' },
                ];

                if (MUSIC_ENABLED) {
                    mapping.push({ id: 'musicModal', app: 'music' });
                }

                mapping.forEach(({ id, app }) => {
                    const modal = document.getElementById(id);
                    if (!modal) return;

                    modal.addEventListener('mousedown', () => {
                        if (!isModalVisible(modal)) return;
                        bringToFront(id);
                        setCurrentTab(app);
                    });
                });
            }

            function isModalVisible(modal) {
                return !!modal && window.getComputedStyle(modal).display !== 'none';
            }

            function setWindowedLayout(modal) {
                modal.style.display = 'block';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = 'calc(100dvh - 72px)';
            }

            function setMaxLayout(modal) {
                modal.style.display = 'block';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = 'calc(100dvh - 72px)';
            }

            function isPhoneViewport() {
                return window.matchMedia('(max-width: 768px)').matches;
            }

            function renderMobileStartApps() {
                const container = document.getElementById('mobileStartApps');
                if (!container) return;

                if (!isPhoneViewport()) {
                    container.classList.remove('active');
                    container.innerHTML = '';
                    return;
                }

                const entries = [];

                if (document.getElementById('editorBottomTab')?.classList.contains('active')) {
                    entries.push({ icon: 'fa-file-alt', label: 'Editor de Texto', action: 'restoreEditorFromTaskbar()' });
                }
                if (document.getElementById('socialBottomTab')?.classList.contains('active')) {
                    entries.push({ icon: 'fa-user-group', label: 'Red Social', action: 'restoreSocialFromTaskbar()' });
                }
                if (document.getElementById('libraryBottomTab')?.classList.contains('active')) {
                    entries.push({ icon: 'fa-book', label: 'Biblioteca', action: 'restoreLibraryFromTaskbar()' });
                }
                if (document.getElementById('filesBottomTab')?.classList.contains('active')) {
                    entries.push({ icon: 'fa-folder', label: 'Archivos', action: 'restoreFilesFromTaskbar()' });
                }
                if (MUSIC_ENABLED && document.getElementById('musicBottomTab')?.classList.contains('active')) {
                    entries.push({ icon: 'fa-music', label: 'Música', action: 'restoreMusicFromTaskbar()' });
                }

                if (entries.length === 0) {
                    container.innerHTML = `
                        <div class="mobile-start-title">Aplicaciones abiertas</div>
                        <div class="mobile-start-empty">No hay ventanas minimizadas.</div>
                    `;
                    container.classList.add('active');
                    return;
                }

                container.innerHTML = `
                    <div class="mobile-start-title">Aplicaciones abiertas</div>
                    ${entries.map((entry) => `
                        <button class="menu-item" onclick="${entry.action}; toggleMenu();">
                            <i class="fas ${entry.icon}"></i>
                            <span>${entry.label}</span>
                        </button>
                    `).join('')}
                `;
                container.classList.add('active');
            }

            function toggleMenu() {
                const menu = document.getElementById('menuPopup');
                menu.classList.toggle('active');
                renderMobileStartApps();
                
                // Cerrar menu al hacer click fuera
                document.addEventListener('click', function(event) {
                    const menuBtn = document.getElementById('menuBtn');
                    if (!menu.contains(event.target) && !menuBtn.contains(event.target)) {
                        menu.classList.remove('active');
                    }
                });
            }

            function toggleRest() {
                const overlay = document.getElementById('restOverlay');
                overlay.classList.toggle('active');
                const menu = document.getElementById('menuPopup');
                menu.classList.remove('active');
            }

            function openTextEditor() {
                const modal = document.getElementById('editorModal');
                const editorBottomTab = document.getElementById('editorBottomTab');

                setWindowedLayout(modal);
                bringToFront('editorModal');
                editorBottomTab.classList.add('active');
                setCurrentTab('editor');

                if (window.TextEditorApp?.openFloating) {
                    window.TextEditorApp.openFloating();
                }
            }

            function openSocialWindow() {
                const modal = document.getElementById('socialModal');
                const socialBottomTab = document.getElementById('socialBottomTab');

                setWindowedLayout(modal);
                bringToFront('socialModal');
                socialBottomTab.classList.add('active');
                setCurrentTab('social');

                if (window.RedSocialApp?.openFloating) {
                    window.RedSocialApp.openFloating();
                }
            }

            function openBibliotecaWindow() {
                const modal = document.getElementById('libraryModal');
                const libraryBottomTab = document.getElementById('libraryBottomTab');

                setWindowedLayout(modal);
                bringToFront('libraryModal');
                libraryBottomTab.classList.add('active');
                setCurrentTab('library');

                if (window.LibraryApp?.openFloating) {
                    window.LibraryApp.openFloating();
                }
            }

            function openFilesWindow() {
                const modal = document.getElementById('filesModal');
                const filesBottomTab = document.getElementById('filesBottomTab');

                setWindowedLayout(modal);
                bringToFront('filesModal');
                filesBottomTab.classList.add('active');
                setCurrentTab('files');

                if (window.ArchivosApp?.openFloating) {
                    window.ArchivosApp.openFloating();
                }
            }

            function updateMusicMiniPlayer(state = {}) {
                if (!MUSIC_ENABLED) return;
                const cover = document.getElementById('musicMiniCover');
                const title = document.getElementById('musicMiniTitle');
                const author = document.getElementById('musicMiniAuthor');
                const playBtn = document.getElementById('musicMiniPlayBtn');

                const hasTrack = !!state.track;
                const coverUrl = state.track?.cover || '/storage/photo/NABBLOGO_BLANCO.png';

                if (cover) cover.src = coverUrl;
                if (title) title.textContent = hasTrack ? (state.track.title || 'Sin título') : 'No hay canción seleccionada';
                if (author) author.textContent = hasTrack ? (state.track.artist || 'Autor desconocido') : 'Selecciona una canción para reproducir.';

                if (playBtn) {
                    playBtn.innerHTML = state.isPlaying
                        ? '<i class="fa-solid fa-pause"></i>'
                        : '<i class="fa-solid fa-play"></i>';
                }
            }

            function miniMusicControl(action, event) {
                if (!MUSIC_ENABLED) return;
                if (event) event.stopPropagation();
                window.postMessage({ app: 'music', type: 'miniControl', action }, '*');
            }

            // Escuchar mensajes del editor (iframe)
            window.addEventListener('message', function(event) {
                const modal = document.getElementById('editorModal');
                const editorBottomTab = document.getElementById('editorBottomTab');
                const socialModal = document.getElementById('socialModal');
                const socialBottomTab = document.getElementById('socialBottomTab');
                const libraryModal = document.getElementById('libraryModal');
                const libraryBottomTab = document.getElementById('libraryBottomTab');
                const filesModal = document.getElementById('filesModal');
                const filesBottomTab = document.getElementById('filesBottomTab');
                const musicModal = document.getElementById('musicModal');
                const musicBottomTab = document.getElementById('musicBottomTab');
                const musicMiniPlayer = document.getElementById('musicMiniPlayer');

                if (!event.data || !event.data.type) return;

                if (event.data.app === 'social') {
                    if (event.data.type === 'minimize') {
                        socialModal.style.display = 'none';
                        socialBottomTab.classList.add('active');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'maximize') {
                        setMaxLayout(socialModal);
                        bringToFront('socialModal');
                        setCurrentTab('social');
                    } else if (event.data.type === 'restore') {
                        setWindowedLayout(socialModal);
                        bringToFront('socialModal');
                        setCurrentTab('social');
                    } else if (event.data.type === 'close') {
                        socialModal.style.display = 'none';
                        socialBottomTab.classList.remove('active');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'focus') {
                        bringToFront('socialModal');
                        setCurrentTab('social');
                    }
                    return;
                }

                if (event.data.app === 'library') {
                    if (event.data.type === 'minimize') {
                        libraryModal.style.display = 'none';
                        libraryBottomTab.classList.add('active');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'maximize') {
                        setMaxLayout(libraryModal);
                        bringToFront('libraryModal');
                        setCurrentTab('library');
                    } else if (event.data.type === 'restore') {
                        setWindowedLayout(libraryModal);
                        bringToFront('libraryModal');
                        setCurrentTab('library');
                    } else if (event.data.type === 'close') {
                        libraryModal.style.display = 'none';
                        libraryBottomTab.classList.remove('active');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'focus') {
                        bringToFront('libraryModal');
                        setCurrentTab('library');
                    }
                    return;
                }

                if (event.data.app === 'files') {
                    if (event.data.type === 'minimize') {
                        filesModal.style.display = 'none';
                        filesBottomTab.classList.add('active');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'maximize') {
                        setMaxLayout(filesModal);
                        bringToFront('filesModal');
                        setCurrentTab('files');
                    } else if (event.data.type === 'restore') {
                        setWindowedLayout(filesModal);
                        bringToFront('filesModal');
                        setCurrentTab('files');
                    } else if (event.data.type === 'close') {
                        filesModal.style.display = 'none';
                        filesBottomTab.classList.remove('active');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'focus') {
                        bringToFront('filesModal');
                        setCurrentTab('files');
                    }
                    return;
                }

                if (event.data.app === 'music') {
                    if (!MUSIC_ENABLED || !musicModal || !musicBottomTab || !musicMiniPlayer) return;

                    if (event.data.type === 'miniState') {
                        updateMusicMiniPlayer(event.data || {});
                    } else if (event.data.type === 'minimize') {
                        musicModal.style.display = 'none';
                        musicBottomTab.classList.add('active');
                        musicMiniPlayer.classList.add('visible');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'maximize') {
                        setMaxLayout(musicModal);
                        bringToFront('musicModal');
                        musicBottomTab.classList.add('active');
                        musicMiniPlayer.classList.remove('visible');
                        setCurrentTab('music');
                    } else if (event.data.type === 'restore') {
                        setWindowedLayout(musicModal);
                        bringToFront('musicModal');
                        musicBottomTab.classList.add('active');
                        musicMiniPlayer.classList.remove('visible');
                        setCurrentTab('music');
                    } else if (event.data.type === 'close') {
                        musicModal.style.display = 'none';
                        musicBottomTab.classList.remove('active');
                        musicMiniPlayer.classList.remove('visible');
                        setFallbackCurrentTab();
                    } else if (event.data.type === 'focus') {
                        bringToFront('musicModal');
                        musicBottomTab.classList.add('active');
                        setCurrentTab('music');
                    }
                    return;
                }

                if (event.data.app !== 'editor') return;

                if (event.data.type === 'minimize') {
                    modal.style.display = 'none';
                    editorBottomTab.classList.add('active');
                    setFallbackCurrentTab();
                } else if (event.data.type === 'maximize') {
                    setMaxLayout(modal);
                    bringToFront('editorModal');
                    setCurrentTab('editor');
                } else if (event.data.type === 'restore') {
                    setWindowedLayout(modal);
                    bringToFront('editorModal');
                    setCurrentTab('editor');
                } else if (event.data.type === 'close') {
                    modal.style.display = 'none';
                    editorBottomTab.classList.remove('active');
                    setFallbackCurrentTab();
                } else if (event.data.type === 'focus') {
                    bringToFront('editorModal');
                    setCurrentTab('editor');
                }
            });

            // Abrir editor desde tab inferior
            function restoreEditorFromTaskbar() {
                const modal = document.getElementById('editorModal');
                const editorBottomTab = document.getElementById('editorBottomTab');

                setWindowedLayout(modal);
                bringToFront('editorModal');
                editorBottomTab.classList.add('active');
                setCurrentTab('editor');

                if (window.TextEditorApp?.openFloating) {
                    window.TextEditorApp.openFloating();
                }
            }

            function restoreSocialFromTaskbar() {
                const modal = document.getElementById('socialModal');
                const socialBottomTab = document.getElementById('socialBottomTab');

                setWindowedLayout(modal);
                bringToFront('socialModal');
                socialBottomTab.classList.add('active');
                setCurrentTab('social');

                if (window.RedSocialApp?.openFloating) {
                    window.RedSocialApp.openFloating();
                }
            }

            function restoreLibraryFromTaskbar() {
                const modal = document.getElementById('libraryModal');
                const libraryBottomTab = document.getElementById('libraryBottomTab');

                setWindowedLayout(modal);
                bringToFront('libraryModal');
                libraryBottomTab.classList.add('active');
                setCurrentTab('library');

                if (window.LibraryApp?.openFloating) {
                    window.LibraryApp.openFloating();
                }
            }

            function restoreFilesFromTaskbar() {
                const modal = document.getElementById('filesModal');
                const filesBottomTab = document.getElementById('filesBottomTab');

                setWindowedLayout(modal);
                bringToFront('filesModal');
                filesBottomTab.classList.add('active');
                setCurrentTab('files');

                if (window.ArchivosApp?.openFloating) {
                    window.ArchivosApp.openFloating();
                }
            }

            function openMusicWindow() {
                if (!MUSIC_ENABLED) return;
                const modal = document.getElementById('musicModal');
                const musicBottomTab = document.getElementById('musicBottomTab');
                const miniPlayer = document.getElementById('musicMiniPlayer');

                if (!modal || !musicBottomTab || !miniPlayer) return;

                setWindowedLayout(modal);
                bringToFront('musicModal');
                musicBottomTab.classList.add('active');
                setCurrentTab('music');
                miniPlayer.classList.remove('visible');

                if (window.MusicApp?.openFloating) {
                    window.MusicApp.openFloating();
                }
            }

            function restoreMusicFromTaskbar() {
                if (!MUSIC_ENABLED) return;
                openMusicWindow();
            }

            function restoreMusicFromMini(event) {
                if (!MUSIC_ENABLED) return;
                if (event) event.stopPropagation();
                openMusicWindow();
            }

            function closeMusicWindow() {
                if (!MUSIC_ENABLED) return;
                const modal = document.getElementById('musicModal');
                const miniPlayer = document.getElementById('musicMiniPlayer');
                const musicBottomTab = document.getElementById('musicBottomTab');

                if (!modal || !miniPlayer || !musicBottomTab) return;

                modal.style.display = 'none';
                miniPlayer.classList.remove('visible');
                musicBottomTab.classList.remove('active');
                setFallbackCurrentTab();
            }

            initDashboardTheme();
            setupFloatingWindowFocus();
            renderMobileStartApps();

            function logout() {
                // Transición de pantalla negra
                const body = document.body;
                body.style.transition = 'background-color 0.5s ease-in';
                body.style.backgroundColor = '#000000';
                
                setTimeout(() => {
                    window.location.href = '{{ route("logout") }}';
                }, 500);
            }

            // Actualizar hora y fecha en tiempo real
            function updateTime() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month = months[now.getMonth()];
                
                document.getElementById('timeHour').textContent = `${hours}:${minutes}`;
                document.getElementById('timeDate').textContent = `${day} ${month}`;
            }

            // Actualizar al cargar la página
            updateTime();
            
            // Actualizar cada segundo
            setInterval(updateTime, 1000);

            // Cerrar menu al hacer click fuera
            document.addEventListener('click', function(event) {
                const menu = document.getElementById('menuPopup');
                const menuBtn = document.getElementById('menuBtn');
                if (!menu.contains(event.target) && !menuBtn.contains(event.target)) {
                    menu.classList.remove('active');
                }
            });

            window.addEventListener('resize', renderMobileStartApps);
        </script>
    </body>
</html>