<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                font-family: 'Figtree', sans-serif;
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

            .sidebar-item svg {
                width: 32px;
                height: 32px;
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

            .taskbar-tab.social {
                background-color: rgba(196, 184, 168, 0.22);
            }

            .taskbar-tab.library {
                background-color: rgba(208, 196, 180, 0.25);
            }

            .taskbar-tab.files {
                background-color: rgba(190, 176, 160, 0.26);
            }

            .user-badge {
                background-color: rgba(181, 155, 121, 0.4);
                border: 1px solid rgba(181, 155, 121, 0.8);
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
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .chat-icon:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

            .chat-icon svg {
                width: 28px;
                height: 28px;
                color: white;
            }

            .theme-toggle-icon {
                position: fixed;
                bottom: 6rem;
                right: 2rem;
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background-color 0.2s;
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

            body.dark-mode .menu-item {
                color: #E2D8CC;
                border-bottom-color: #B59B79;
            }

            body.dark-mode .menu-item:hover {
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
            body.dark-mode #editorModal .save-confirm-btn {
                background: #272022 !important;
                color: #E2D8CC !important;
                border-color: #B59B79 !important;
            }

            body.dark-mode #socialModal .post-action-btn,
            body.dark-mode #editorModal .toolbar-btn,
            body.dark-mode #editorModal .save-segmented-btn,
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

            .menu-item svg {
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

            .rest-moon {
                width: 120px;
                height: 120px;
                margin: 0 auto 2rem;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .rest-moon svg {
                width: 60px;
                height: 60px;
                color: rgba(255, 255, 255, 0.4);
            }

            .floating-app {
                position: fixed;
                display: none;
                top: 0;
                left: 0;
                width: 100%;
                height: calc(100vh - 72px);
                background: transparent;
                z-index: 1000;
                pointer-events: none;
            }
        </style>
    </head>
    <body class="dashboard-bg min-h-screen flex flex-col">
        <!-- Chat Icon (Top Right) -->
        <div class="chat-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
        </div>

        <!-- Theme Toggle Icon (Bottom Right) -->
        <div class="theme-toggle-icon" onclick="toggleDarkMode()" title="Modo oscuro">
            <i id="themeToggleIcon" class="fa-solid fa-moon"></i>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex">
            <!-- Left Sidebar -->
            <div class="w-24 pt-8 pb-32 px-4 flex flex-col gap-12">
                <!-- Editor de Texto - Solo para Admin -->
                @if($userType === 'admin')
                <div class="sidebar-item" onclick="openTextEditor()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Editor de<br/>Texto</span>
                </div>
                @endif

                <!-- Red Social -->
                <div class="sidebar-item" onclick="openSocialWindow()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM9 20H4v-2a6 6 0 0112 0v2H9z" />
                    </svg>
                    <span>Red<br/>Social</span>
                </div>

                <!-- Biblioteca -->
                <div class="sidebar-item" onclick="openBibliotecaWindow()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17.25c0 5.17 3.438 9.6 8.03 10.63m0-13c5.5 0 10 4.745 10 10.25 0 5.17-3.438 9.6-8.03 10.63M12 6.253L9.612 15.29c-.133.466-.228.965-.228 1.46 0 4.413 3.134 8.25 7.022 8.25s7.022-3.837 7.022-8.25c0-.495-.095-.994-.228-1.46L12 6.253z" />
                    </svg>
                    <span>Biblioteca</span>
                </div>

                <!-- Archivos -->
                <div class="sidebar-item" onclick="openFilesWindow()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <span>Archivos</span>
                </div>
            </div>

            <!-- Center Content - Mostly Empty -->
            <div class="flex-1"></div>

            <!-- Right Sidebar -->
            <div class="w-24 pt-8 pb-32 px-4 flex flex-col gap-12 items-center">
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bottom-bar">
            <div class="taskbar-left">
                <div class="flex items-center gap-2 cursor-pointer" id="menuBtn" onclick="toggleMenu()">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.657 14.243a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM11 17v-1a1 1 0 10-2 0v1a1 1 0 102 0zM5.757 15.657a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM5.757 5.757a1 1 0 000-1.414L5.05 3.636a1 1 0 10-1.414 1.414l.707.707z" />
                    </svg>
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
            </div>

            <!-- Menu Popup -->
            <div class="menu-popup" id="menuPopup">
                <div class="menu-header">Menú de Inicio</div>
                <div class="menu-item" onclick="toggleRest()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 108.646 3.646 9.003 9.003 0 0020.354 15.354z" />
                    </svg>
                    <span>Descanso</span>
                </div>
                <div class="menu-item" onclick="logout()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Cerrar Sesión</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="user-badge">
                    {{ strtoupper($userType) }}
                </div>
                <div class="text-sm" id="timeDisplay">
                    <div id="timeHour">00:00</div>
                    <div id="timeDate">00 Mon</div>
                </div>
            </div>
        </div>

        <!-- Rest Overlay -->
        <div class="rest-overlay" id="restOverlay" onclick="toggleRest()">
            <div class="rest-content">
                <div class="rest-moon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 108.646 3.646 9.003 9.003 0 0020.354 15.354z" />
                    </svg>
                </div>
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

        <script>
            const DASHBOARD_THEME_KEY = 'dashboard_theme_v1';

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
                editorBottomTab.classList.remove('current');
                socialBottomTab.classList.remove('current');
                libraryBottomTab.classList.remove('current');
                filesBottomTab.classList.remove('current');

                if (app === 'editor' && editorBottomTab.classList.contains('active')) {
                    editorBottomTab.classList.add('current');
                }
                if (app === 'social' && socialBottomTab.classList.contains('active')) {
                    socialBottomTab.classList.add('current');
                }
                if (app === 'library' && libraryBottomTab.classList.contains('active')) {
                    libraryBottomTab.classList.add('current');
                }
                if (app === 'files' && filesBottomTab.classList.contains('active')) {
                    filesBottomTab.classList.add('current');
                }
            }

            function setFallbackCurrentTab() {
                const editorModal = document.getElementById('editorModal');
                const socialModal = document.getElementById('socialModal');
                const libraryModal = document.getElementById('libraryModal');
                const filesModal = document.getElementById('filesModal');
                const editorVisible = editorModal.style.display !== 'none';
                const socialVisible = socialModal.style.display !== 'none';
                const libraryVisible = libraryModal.style.display !== 'none';
                const filesVisible = filesModal.style.display !== 'none';

                const visible = [];
                if (editorVisible) visible.push({ app: 'editor', id: 'editorModal', z: Number(editorModal.style.zIndex || 0) });
                if (socialVisible) visible.push({ app: 'social', id: 'socialModal', z: Number(socialModal.style.zIndex || 0) });
                if (libraryVisible) visible.push({ app: 'library', id: 'libraryModal', z: Number(libraryModal.style.zIndex || 0) });
                if (filesVisible) visible.push({ app: 'files', id: 'filesModal', z: Number(filesModal.style.zIndex || 0) });

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
                const modals = [editorModal, socialModal, libraryModal, filesModal];

                const visibleOthers = modals
                    .filter(modal => modal && modal.id !== modalId && modal.style.display !== 'none')
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

                mapping.forEach(({ id, app }) => {
                    const modal = document.getElementById(id);
                    if (!modal) return;

                    modal.addEventListener('mousedown', () => {
                        if (modal.style.display === 'none') return;
                        bringToFront(id);
                        setCurrentTab(app);
                    });
                });
            }

            function setWindowedLayout(modal) {
                modal.style.display = 'block';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = 'calc(100vh - 72px)';
            }

            function setMaxLayout(modal) {
                modal.style.display = 'block';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = 'calc(100vh - 72px)';
            }

            function toggleMenu() {
                const menu = document.getElementById('menuPopup');
                menu.classList.toggle('active');
                
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

            initDashboardTheme();
            setupFloatingWindowFocus();

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
        </script>
    </body>
</html>