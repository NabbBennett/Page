<style>
    #socialModal .app-window {
        position: fixed;
        top: 50px;
        left: 50%;
        transform: translateX(-50%);
        width: 90vw;
        height: 84vh;
        display: flex;
        flex-direction: column;
        border: 1px solid #5a5250;
        border-radius: 1rem;
        overflow: hidden;
        background: #E2D8CC;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        resize: both;
        user-select: none;
        pointer-events: auto;
        color: #443C3D;
    }

    #socialModal .app-window.maximized {
        top: 0;
        left: 0;
        width: 100%;
        height: calc(100vh - 72px);
        transform: none;
        border-radius: 0;
        resize: none;
    }

    #socialModal .window-header {
        height: 52px;
        background: #443C3D;
        color: #E2D8CC;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 16px;
        flex-shrink: 0;
        cursor: move;
    }

    #socialModal .window-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
    }

    #socialModal .window-controls {
        display: flex;
        gap: 10px;
    }

    #socialModal .window-btn {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.2);
        color: #E2D8CC;
        cursor: pointer;
    }

    #socialModal .window-btn:hover { background: rgba(255, 255, 255, 0.35); }
    #socialModal .window-btn.close:hover { background: #9b2f2f; }

    #socialModal .resize-handle {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 20px;
        height: 20px;
        cursor: se-resize;
        background: linear-gradient(135deg, transparent 50%, #443C3D 50%);
        opacity: 0.35;
    }

    #socialModal .app-window.maximized .resize-handle { display: none; }

    #socialModal .window-body {
        flex: 1;
        display: flex;
        overflow: hidden;
    }

    #socialModal .left-menu {
        width: 210px;
        border-right: 2px solid #5a5250;
        background: #D0C4B4;
        transition: width 0.2s ease;
        flex-shrink: 0;
        padding: 14px;
    }

    #socialModal .left-menu.collapsed {
        width: 56px;
        padding: 10px 8px;
    }

    #socialModal .collapse-btn {
        width: 100%;
        border: none;
        background: transparent;
        color: #443C3D;
        font-size: 22px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    #socialModal .menu-item {
        width: 100%;
        border: none;
        background: transparent;
        color: #443C3D;
        padding: 10px 12px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        font-size: 1.05rem;
        margin-bottom: 8px;
    }

    #socialModal .menu-item span { font-size: 1.1rem; }

    #socialModal .menu-item.active {
        background: #443C3D;
        color: #E2D8CC;
        font-weight: 700;
    }

    #socialModal .left-menu.collapsed .menu-item span { display: none; }

    #socialModal .content {
        flex: 1;
        overflow: auto;
        padding: 14px;
    }

    #socialModal .section { display: none; }
    #socialModal .section.active { display: block; }

    #socialModal .composer {
        background: #E2D8CC;
        border: 2px solid #5a5250;
        border-radius: 18px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    #socialModal .composer input {
        flex: 1;
        border: 2px solid #5a5250;
        border-radius: 14px;
        background: #D0C4B4;
        padding: 10px 14px;
        font-size: 1rem;
        color: #443C3D;
        outline: none;
    }

    #socialModal .primary-btn {
        border: none;
        border-radius: 14px;
        background: #443C3D;
        color: #E2D8CC;
        padding: 10px 16px;
        font-weight: 700;
        cursor: pointer;
        font-size: 1rem;
    }

    #socialModal .card {
        background: #f2f2f2;
        border: 2px solid #5a5250;
        border-radius: 16px;
        margin-bottom: 14px;
        overflow: hidden;
    }

    #socialModal .post-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px;
    }

    #socialModal .avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        border: 2px solid #5a5250;
        background: #B59B79;
        object-fit: cover;
    }

    #socialModal .post-body { padding: 0 14px 14px; font-size: 1rem; line-height: 1.55; }

    #socialModal .post-image {
        width: calc(100% - 28px);
        margin: 0 14px 14px;
        border-radius: 12px;
        border: none;
        height: 340px;
        max-height: 340px;
        object-fit: contain;
        object-position: left center;
        background: transparent;
    }

    #socialModal #sectionInicio .post-image {
        height: 300px;
        max-height: 300px;
    }

    #socialModal .post-actions {
        border-top: 2px solid #5a5250;
        background: #E2D8CC;
        padding: 12px 14px;
        display: flex;
        justify-content: space-around;
        font-weight: 600;
        font-size: 1rem;
    }

    #socialModal .post-action-btn {
        border: none;
        background: transparent;
        color: #443C3D;
        font-weight: 700;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px 10px;
        border-radius: 12px;
    }

    #socialModal .post-action-btn:hover {
        background: #D0C4B4;
    }

    #socialModal .post-action-btn.liked {
        color: #d42f2f;
    }

    #socialModal .post-action-btn.delete {
        color: #9b2f2f;
    }

    #socialModal .comments-list {
        margin-top: 12px;
        max-height: 280px;
        overflow: auto;
        display: grid;
        gap: 10px;
    }

    #socialModal .comment-item {
        border: 2px solid #5a5250;
        border-radius: 14px;
        background: #f2f2f2;
        padding: 10px 12px;
    }

    #socialModal .comment-media {
        width: min(100%, 420px);
        height: 220px;
        max-height: 220px;
        object-fit: contain;
        object-position: left center;
        display: block;
        border: none;
        border-radius: 10px;
        margin: 8px 0 0 0;
        background: transparent;
    }

    #socialModal .comment-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 6px;
    }

    #socialModal .comment-head-main {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    #socialModal .comment-delete-btn {
        border: 1px solid #9b2f2f;
        background: #fff;
        color: #9b2f2f;
        border-radius: 10px;
        padding: 4px 8px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 700;
        white-space: nowrap;
    }

    #socialModal .comment-delete-btn:hover {
        background: #9b2f2f;
        color: #fff;
    }

    #socialModal .comment-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 2px solid #5a5250;
        object-fit: cover;
    }

    #socialModal .profiles-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    #socialModal .profile-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #f2f2f2;
        border: 2px solid #5a5250;
        border-radius: 18px;
        padding: 14px;
        margin-bottom: 12px;
    }

    #socialModal .profile-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    #socialModal .profile-name { font-weight: 800; font-size: 1.25rem; }
    #socialModal .profile-user { color: #7a7172; font-size: 0.95rem; }
    #socialModal .profile-bio { font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 780px; }

    #socialModal .ghost-btn {
        border: 2px solid #5a5250;
        border-radius: 14px;
        background: #fff;
        color: #443C3D;
        padding: 10px 18px;
        font-weight: 700;
        cursor: pointer;
        font-size: 1rem;
    }

    #socialModal .profile-cover {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-bottom: 2px solid #5a5250;
    }

    #socialModal .profile-cover-wrap {
        position: relative;
    }

    #socialModal .profile-edit-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        border: 2px solid rgba(68, 60, 61, 0.9);
        border-radius: 12px;
        background: rgba(226, 216, 204, 0.92);
        color: #443C3D;
        padding: 8px 12px;
        font-weight: 700;
        cursor: pointer;
        font-size: 0.9rem;
        backdrop-filter: blur(2px);
    }

    #socialModal .profile-edit-btn:hover {
        background: #E2D8CC;
    }

    #socialModal .profile-top {
        background: #f2f2f2;
        border-bottom: 2px solid #5a5250;
        padding: 14px;
        display: flex;
        gap: 14px;
        align-items: center;
    }

    body.dark-mode #socialModal .profile-top {
        background: #272022;
        color: #E2D8CC;
    }

    body.dark-mode #socialModal .profile-top .profile-name,
    body.dark-mode #socialModal .profile-top .profile-user,
    body.dark-mode #socialModal .profile-top .profile-meta {
        color: #E2D8CC !important;
    }

    body.dark-mode #socialModal .profile-top .profile-meta strong {
        color: #E2D8CC !important;
    }

    #socialModal .tabs {
        display: flex;
        gap: 10px;
        padding: 12px 14px;
        border-bottom: 2px solid #5a5250;
        background: #D0C4B4;
        font-weight: 700;
        font-size: 1rem;
    }

    body.dark-mode #socialModal .tabs {
        background: #1f1a1c;
    }

    #socialModal .tabs button {
        border: 1px solid transparent;
        background: rgba(255, 255, 255, 0.32);
        color: #5f5758;
        cursor: pointer;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 1rem;
        transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
    }

    #socialModal .tabs button:hover {
        transform: translateY(-1px);
        border-color: rgba(68, 60, 61, 0.45);
        color: #443C3D;
    }

    #socialModal .tabs button.active {
        color: #E2D8CC;
        background: #443C3D;
        border-color: #5a5250;
    }

    body.dark-mode #socialModal .tabs button {
        background: rgba(39, 32, 34, 0.72);
        color: #CBBEAF;
    }

    body.dark-mode #socialModal .tabs button:hover {
        border-color: rgba(181, 155, 121, 0.6);
        color: #E2D8CC;
    }

    body.dark-mode #socialModal .tabs button.active {
        background: #B59B79;
        color: #1C1819;
        border-color: #B59B79;
    }

    @keyframes tabSlideInRight {
        from { opacity: 0; transform: translateX(10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes tabSlideInLeft {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    #socialModal .tab-enter-right {
        animation: tabSlideInRight 0.2s ease;
    }

    #socialModal .tab-enter-left {
        animation: tabSlideInLeft 0.2s ease;
    }

    #socialModal .gallery {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        padding: 14px;
    }

    #socialModal .gallery img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border: 2px solid #5a5250;
        border-radius: 14px;
    }

    #socialModal .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        pointer-events: auto;
    }

    #socialModal .modal-backdrop.active { display: flex; }

    #socialModal .image-viewer-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.82);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2600;
        padding: 16px;
    }

    #socialModal .image-viewer-backdrop.active {
        display: flex;
    }

    #socialModal .image-viewer-content {
        position: relative;
        width: min(1200px, calc(100vw - 32px));
        height: min(88vh, calc(100vh - 32px));
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #socialModal .image-viewer-img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 14px 36px rgba(0, 0, 0, 0.5);
        background: transparent;
    }

    #socialModal .image-viewer-close {
        position: absolute;
        top: 6px;
        right: 6px;
        z-index: 5;
        pointer-events: auto;
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        cursor: pointer;
        font-size: 1.1rem;
    }

    #socialModal .image-viewer-close:hover {
        background: rgba(255, 255, 255, 0.28);
    }

    #socialModal .modal-box {
        width: min(860px, calc(100% - 24px));
        max-height: calc(100% - 24px);
        overflow: auto;
        background: #E2D8CC;
        border: 2px solid #5a5250;
        border-radius: 16px;
        padding: 18px;
    }

    #socialModal .modal-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    #socialModal .input,
    #socialModal .textarea,
    #socialModal .select {
        width: 100%;
        border: 2px solid #5a5250;
        border-radius: 12px;
        background: #f2f2f2;
        color: #443C3D;
        padding: 10px 12px;
        margin-top: 6px;
        outline: none;
        font-size: 1rem;
    }

    #socialModal .textarea { min-height: 120px; resize: vertical; }

    #socialModal .row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    #socialModal .modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 14px;
    }

    #socialModal .modal-actions-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
        margin-top: 14px;
    }

    #socialModal .small { color: #7a7172; font-size: 0.9rem; }

    #socialModal .danger-btn {
        border: 2px solid #9b2f2f;
        border-radius: 14px;
        background: #fff;
        color: #9b2f2f;
        padding: 10px 12px;
        font-weight: 700;
        cursor: pointer;
        font-size: 1rem;
    }

    #socialModal .danger-btn:hover {
        background: #9b2f2f;
        color: #fff;
    }

    #socialModal .hidden-file-input {
        display: none;
    }

    #socialModal .upload-zone {
        margin-top: 8px;
        border: 2px dashed #5a5250;
        border-radius: 14px;
        background: #D0C4B4;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        overflow: hidden;
        transition: background-color 0.2s, border-color 0.2s;
        position: relative;
    }

    #socialModal .upload-zone:hover {
        background: #d6cbbe;
        border-color: #443C3D;
    }

    #socialModal .upload-zone.has-preview {
        padding: 0;
        border-style: solid;
        background: #f2f2f2;
    }

    #socialModal .upload-zone-content {
        text-align: center;
        color: #7a7172;
        padding: 12px;
    }

    #socialModal .upload-zone-content i {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 6px;
        color: #a79d90;
    }

    #socialModal .upload-zone-title {
        font-weight: 600;
        color: #6f6667;
    }

    #socialModal .upload-zone-sub {
        font-size: 0.82rem;
        margin-top: 4px;
    }

    #socialModal .upload-preview {
        display: none;
        width: 100%;
        height: 180px;
        object-fit: cover;
        border: none;
    }

    #socialModal .upload-zone.has-preview .upload-preview {
        display: block;
    }

    #socialModal .upload-zone.has-preview .upload-zone-content {
        display: none;
    }

    #socialModal .upload-zone.round-preview .upload-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px solid #5a5250;
        margin: 10px auto;
    }

    @media (max-width: 900px) {
        #socialModal .left-menu { width: 74px; padding: 8px; }
        #socialModal .left-menu .menu-item span { display: none; }
        #socialModal .composer input { font-size: 0.95rem; }
        #socialModal .post-body,
        #socialModal .post-actions,
        #socialModal .tabs,
        #socialModal .profile-name,
        #socialModal .primary-btn,
        #socialModal .ghost-btn,
        #socialModal .input,
        #socialModal .textarea,
        #socialModal .select { font-size: 0.95rem; }
        #socialModal .profile-bio,
        #socialModal .profile-user,
        #socialModal .small { font-size: 0.85rem; }
    }
</style>

<div class="app-window" id="socialWindow">
    <div class="window-header">
        <div class="window-title">
            <i class="fa-solid fa-user-group"></i>
            <span>Red Social</span>
        </div>
        <div class="window-controls">
            <button class="window-btn" type="button" onclick="minimizeWindow()"><i class="fa-solid fa-minus"></i></button>
            <button class="window-btn" type="button" onclick="toggleMaximize()" id="maxBtn"><i class="fa-regular fa-square"></i></button>
            <button class="window-btn close" type="button" onclick="closeWindow()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>

    <div class="window-body">
        <aside class="left-menu" id="leftMenu">
            <button class="collapse-btn" type="button" onclick="toggleMenuCollapse()">×</button>
            <button class="menu-item active" id="menuInicio" type="button" onclick="openSection('inicio')">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </button>
            <button class="menu-item" id="menuPerfiles" type="button" onclick="openSection('perfiles')">
                <i class="fa-solid fa-user"></i>
                <span>Perfiles</span>
            </button>
        </aside>

        <main class="content">
            <section id="sectionInicio" class="section active">
                @if($userType === 'admin')
                <div class="composer">
                    <input type="text" readonly value="¿Qué quieres publicar hoy?" />
                    <button type="button" class="primary-btn" onclick="openPostModal()"><i class="fa-solid fa-plus"></i> Publicar</button>
                </div>
                @endif
                <div id="feedList"></div>
            </section>
            

            <section id="sectionPerfiles" class="section">
                <div class="profiles-header">
                    <h2 style="font-size: 1.5rem; font-weight: 800;">Perfiles Sugeridos</h2>
                    @if($userType === 'admin')
                        <button type="button" class="primary-btn" onclick="openProfileModal()"><i class="fa-solid fa-plus"></i> Crear Perfil</button>
                    @endif
                </div>
                <div id="profilesList"></div>
            </section>

            <section id="sectionPerfilDetalle" class="section"></section>
            <section id="sectionPostDetalle" class="section"></section>
        </main>
    </div>
</div>

@if($userType === 'admin')
<div class="modal-backdrop" id="postModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3 style="font-size: 1.4rem; font-weight: 800;">Crear Publicación</h3>
            <button type="button" class="window-btn close" onclick="closePostModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <label style="font-weight:700; font-size: 1rem;">Publicar como:</label>
        <select class="select" id="postCharacter"></select>

        <div style="margin-top: 12px;">
            <label style="font-weight:700; font-size: 1rem;">¿Qué estás pensando?</label>
            <textarea class="textarea" id="postText" placeholder="Texto opcional"></textarea>
        </div>

        <div style="margin-top: 12px;">
            <label style="font-weight:700; font-size: 1rem;"><i class="fa-regular fa-image"></i> Imagen (opcional)</label>
            <input class="hidden-file-input" type="file" id="postImage" accept="image/*" />
            <div class="upload-zone" id="postImageZone" onclick="triggerFileInput('postImage')">
                <img id="postImagePreview" class="upload-preview" alt="Vista previa publicación">
                <div class="upload-zone-content">
                    <i class="fa-regular fa-image"></i>
                    <div class="upload-zone-title">Haz clic para subir una imagen</div>
                    <div class="upload-zone-sub">PNG · JPG · GIF · WEBP</div>
                </div>
            </div>
            <div class="small">Debes escribir texto o subir imagen (al menos uno).</div>
        </div>

        <div class="modal-actions">
            <button type="button" class="ghost-btn" onclick="closePostModal()">Cancelar</button>
            <button type="button" class="primary-btn" onclick="publishPost()">Publicar</button>
        </div>
    </div>
</div>
@endif

<div class="modal-backdrop" id="profileModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3 style="font-size: 1.4rem; font-weight: 800;">Crear Nuevo Perfil</h3>
            <button type="button" class="window-btn close" onclick="closeProfileModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="row-2">
            <div>
                <label style="font-weight:700; font-size: 1rem;">Nombre completo *</label>
                <input class="input" id="profileName" placeholder="Ej: Elena Reyes" />
            </div>
            <div>
                <label style="font-weight:700; font-size: 1rem;">Usuario *</label>
                <input class="input" id="profileUsername" placeholder="Ej: @elenareyes" />
            </div>
        </div>

        <div style="margin-top: 12px;">
            <label style="font-weight:700; font-size: 1rem;">Biografía *</label>
            <input class="input" id="profileBio" placeholder="Tu biografía" />
        </div>

        <div class="row-2" style="margin-top: 12px;">
            <div>
                <label style="font-weight:700; font-size: 1rem;">Avatar / Icono *</label>
                <input class="hidden-file-input" type="file" id="profileAvatar" accept="image/*" />
                <div class="upload-zone round-preview" id="profileAvatarZone" onclick="triggerFileInput('profileAvatar')">
                    <img id="profileAvatarPreview" class="upload-preview" alt="Vista previa avatar">
                    <div class="upload-zone-content">
                        <i class="fa-regular fa-user"></i>
                        <div class="upload-zone-title">Subir avatar</div>
                        <div class="upload-zone-sub">Imagen cuadrada recomendada</div>
                    </div>
                </div>
            </div>
            <div>
                <label style="font-weight:700; font-size: 1rem;">Banner *</label>
                <input class="hidden-file-input" type="file" id="profileBanner" accept="image/*" />
                <div class="upload-zone" id="profileBannerZone" onclick="triggerFileInput('profileBanner')">
                    <img id="profileBannerPreview" class="upload-preview" alt="Vista previa banner">
                    <div class="upload-zone-content">
                        <i class="fa-regular fa-image"></i>
                        <div class="upload-zone-title">Subir banner</div>
                        <div class="upload-zone-sub">Formato horizontal recomendado</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-actions">
            <button type="button" class="ghost-btn" onclick="closeProfileModal()">Cancelar</button>
            <button type="button" class="primary-btn" onclick="createProfile()">Crear Perfil</button>
        </div>
    </div>
</div>

<div class="modal-backdrop" id="editProfileModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3 style="font-size: 1.4rem; font-weight: 800;">Editar Perfil</h3>
            <button type="button" class="window-btn close" onclick="closeEditProfileModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="row-2">
            <div>
                <label style="font-weight:700; font-size: 1rem;">Nombre completo *</label>
                <input class="input" id="editProfileName" placeholder="Ej: Elena Reyes" />
            </div>
            <div>
                <label style="font-weight:700; font-size: 1rem;">Usuario *</label>
                <input class="input" id="editProfileUsername" placeholder="Ej: @elenareyes" />
            </div>
        </div>

        <div style="margin-top: 12px;">
            <label style="font-weight:700; font-size: 1rem;">Biografía *</label>
            <input class="input" id="editProfileBio" placeholder="Tu biografía" />
        </div>

        <div class="row-2" style="margin-top: 12px;">
            <div>
                <label style="font-weight:700; font-size: 1rem;">Avatar</label>
                <input class="hidden-file-input" type="file" id="editProfileAvatar" accept="image/*" />
                <div class="upload-zone round-preview" id="editProfileAvatarZone" onclick="triggerFileInput('editProfileAvatar')">
                    <img id="editProfileAvatarPreview" class="upload-preview" alt="Vista previa avatar editar">
                    <div class="upload-zone-content">
                        <i class="fa-regular fa-user"></i>
                        <div class="upload-zone-title">Cambiar avatar</div>
                    </div>
                </div>
            </div>
            <div>
                <label style="font-weight:700; font-size: 1rem;">Banner</label>
                <input class="hidden-file-input" type="file" id="editProfileBanner" accept="image/*" />
                <div class="upload-zone" id="editProfileBannerZone" onclick="triggerFileInput('editProfileBanner')">
                    <img id="editProfileBannerPreview" class="upload-preview" alt="Vista previa banner editar">
                    <div class="upload-zone-content">
                        <i class="fa-regular fa-image"></i>
                        <div class="upload-zone-title">Cambiar banner</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-actions-3">
            <button type="button" class="ghost-btn" onclick="closeEditProfileModal()">Cancelar</button>
            <button type="button" class="primary-btn" onclick="saveProfileChanges()">Guardar</button>
            <button type="button" class="danger-btn" onclick="deleteProfile()">Eliminar</button>
        </div>
    </div>
</div>

@include('partials.imagen')

<script>
    const USER_TYPE = @json($userType ?? 'guest');
    const CSRF_TOKEN = @json(csrf_token());
    const STORAGE_CHARACTERS = 'social_characters_v1';
    const STORAGE_POSTS = 'social_posts_v1';
    const STORAGE_POST_LIKES = `social_liked_posts_v1_${USER_TYPE}`;
    const MIN_WIDTH = 320;
    const MIN_HEIGHT = 240;

    let currentView = 'inicio';
    let selectedProfileId = null;
    let editingProfileId = null;
    let selectedPostId = null;
    let isMaximized = false;

    const defaultCharacters = [
        { id: 'char-1', name: 'Elena Reyes', username: '@elenareyes', bio: 'Diseñadora digital | Amante del arte vintage | Café ☕', avatar: 'https://api.dicebear.com/9.x/thumbs/svg?seed=Elena&backgroundColor=b59b79', banner: 'https://images.unsplash.com/photo-1508264165352-258a6f82b407?auto=format&fit=crop&w=1200&q=80', followers: 1234, following: 567, joined: 'Enero 2015' },
        { id: 'char-2', name: 'Carlos Mendoza', username: '@carlosmdev', bio: 'Desarrollador Full Stack | Tech enthusiast | Always learning...', avatar: 'https://api.dicebear.com/9.x/thumbs/svg?seed=Carlos&backgroundColor=b59b79', banner: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=80', followers: 980, following: 410, joined: 'Marzo 2018' },
        { id: 'char-3', name: 'Sofía Luna', username: '@sofialuna', bio: 'Exploradora digital | Fotógrafa | Viajera 🌍 📷', avatar: 'https://api.dicebear.com/9.x/thumbs/svg?seed=Sofia&backgroundColor=b59b79', banner: 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?auto=format&fit=crop&w=1200&q=80', followers: 802, following: 356, joined: 'Julio 2020' }
    ];

    const defaultPosts = [
        {
            id: 'post-1',
            characterId: 'char-1',
            text: '¡Acabo de terminar mi primer proyecto! Muy emocionada de compartirlo con todos. 🎉',
            image: '',
            createdAt: Date.now() - (2 * 60 * 60 * 1000),
            likes: 24,
            commentsList: [
                { id: 'comment-1', characterId: 'char-2', text: '¡Felicidades!', createdAt: Date.now() - (30 * 60 * 1000) },
                { id: 'comment-2', characterId: 'char-3', text: 'Increíble trabajo', createdAt: Date.now() - (60 * 60 * 1000) },
            ],
        },
        {
            id: 'post-2',
            characterId: 'char-2',
            text: 'Trabajando en algo increíble. No puedo esperar para mostrárselo al mundo. #desarrollo #tech',
            image: '',
            createdAt: Date.now() - (4 * 60 * 60 * 1000),
            likes: 42,
            commentsList: [
                { id: 'comment-3', characterId: 'char-1', text: '¡Se viene algo grande!', createdAt: Date.now() - (90 * 60 * 1000) },
            ],
        },
        {
            id: 'post-3',
            characterId: 'char-1',
            text: 'Trabajando en un nuevo proyecto de diseño vintage. ¡Me encanta este estilo retro! 😍✨',
            image: 'https://images.unsplash.com/photo-1487611459768-bd414656ea10?auto=format&fit=crop&w=1000&q=80',
            createdAt: Date.now() - (3 * 60 * 60 * 1000),
            likes: 89,
            commentsList: [
                { id: 'comment-4', characterId: 'char-3', text: 'Ese estilo está brutal 🔥', createdAt: Date.now() - (70 * 60 * 1000) },
                { id: 'comment-5', characterId: 'char-2', text: 'Muy buen diseño', createdAt: Date.now() - (50 * 60 * 1000) },
            ],
        },
        {
            id: 'post-4',
            characterId: 'char-1',
            text: '',
            image: 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80',
            createdAt: Date.now() - (8 * 60 * 60 * 1000),
            likes: 54,
            commentsList: [
                { id: 'comment-6', characterId: 'char-2', text: 'Qué foto tan buena 👏', createdAt: Date.now() - (7 * 60 * 60 * 1000) },
                { id: 'comment-7', characterId: 'char-3', text: 'Hermosa vista', createdAt: Date.now() - (6 * 60 * 60 * 1000) },
                { id: 'comment-8', characterId: 'char-1', text: 'Gracias por comentar 💛', createdAt: Date.now() - (5 * 60 * 60 * 1000) },
            ],
        }
    ];

    function sendSocialMessage(type, extra = {}) {
        const payload = { app: 'social', type, ...extra };
        if (window.parent && window.parent !== window) {
            window.parent.postMessage(payload, '*');
        } else {
            window.postMessage(payload, '*');
        }
    }

    function openImageViewer(imageSrc, imageAlt = 'Vista previa') {
        if (!imageSrc) return;
        const modal = document.getElementById('imageViewerModal');
        const image = document.getElementById('imageViewerImg');
        if (!modal || !image) return;
        image.src = imageSrc;
        image.alt = imageAlt;
        modal.classList.add('active');
    }

    function closeImageViewer() {
        const modal = document.getElementById('imageViewerModal');
        const image = document.getElementById('imageViewerImg');
        if (!modal || !image) return;
        modal.classList.remove('active');
        image.removeAttribute('src');
    }

    function getCharacters() {
        const raw = localStorage.getItem(STORAGE_CHARACTERS);
        if (!raw) {
            localStorage.setItem(STORAGE_CHARACTERS, JSON.stringify(defaultCharacters));
            return [...defaultCharacters];
        }
        return JSON.parse(raw);
    }

    function setCharacters(items) { localStorage.setItem(STORAGE_CHARACTERS, JSON.stringify(items)); }

    function normalizePost(post) {
        const commentsList = Array.isArray(post?.commentsList) ? post.commentsList : [];
        return {
            ...post,
            likes: Math.max(0, Number(post?.likes || 0)),
            commentsList,
            comments: commentsList.length,
        };
    }

    function getPosts() {
        const raw = localStorage.getItem(STORAGE_POSTS);
        if (!raw) {
            const normalizedDefaults = defaultPosts.map(normalizePost);
            localStorage.setItem(STORAGE_POSTS, JSON.stringify(normalizedDefaults));
            return [...normalizedDefaults];
        }
        const parsed = JSON.parse(raw).map(normalizePost);
        localStorage.setItem(STORAGE_POSTS, JSON.stringify(parsed));
        return parsed;
    }

    function setPosts(items) { localStorage.setItem(STORAGE_POSTS, JSON.stringify(items.map(normalizePost))); }

    function getLikedPostIds() {
        const raw = localStorage.getItem(STORAGE_POST_LIKES);
        if (!raw) return [];
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    }

    function setLikedPostIds(items) {
        localStorage.setItem(STORAGE_POST_LIKES, JSON.stringify(items));
    }

    function hasLikedPost(postId) {
        return getLikedPostIds().includes(postId);
    }

    function findPost(postId) {
        return getPosts().find(item => item.id === postId);
    }

    function findCharacter(id) { return getCharacters().find(item => item.id === id); }

    function hoursAgoLabel(timestamp) {
        const diffH = Math.max(1, Math.floor((Date.now() - timestamp) / (60 * 60 * 1000)));
        return `hace ${diffH} hora${diffH === 1 ? '' : 's'}`;
    }

    function openSection(section) {
        currentView = section;
        document.getElementById('sectionInicio').classList.remove('active');
        document.getElementById('sectionPerfiles').classList.remove('active');
        document.getElementById('sectionPerfilDetalle').classList.remove('active');
        document.getElementById('sectionPostDetalle').classList.remove('active');
        document.getElementById('menuInicio').classList.remove('active');
        document.getElementById('menuPerfiles').classList.remove('active');

        if (section === 'inicio') {
            document.getElementById('sectionInicio').classList.add('active');
            document.getElementById('menuInicio').classList.add('active');
        } else if (section === 'perfiles') {
            document.getElementById('sectionPerfiles').classList.add('active');
            document.getElementById('menuPerfiles').classList.add('active');
        } else if (section === 'postDetalle') {
            document.getElementById('sectionPostDetalle').classList.add('active');
            document.getElementById('menuInicio').classList.add('active');
        } else {
            document.getElementById('sectionPerfilDetalle').classList.add('active');
            document.getElementById('menuPerfiles').classList.add('active');
        }
    }

    function toggleMenuCollapse() {
        document.getElementById('leftMenu').classList.toggle('collapsed');
    }

    function renderComposerAvatar() {
        const firstChar = getCharacters()[0];
        const composerAvatar = document.getElementById('composerAvatar');
        if (!composerAvatar) return;
        composerAvatar.src = firstChar?.avatar || '';
    }

    function renderFeed() {
        const feed = document.getElementById('feedList');
        const posts = getPosts().sort((a, b) => b.createdAt - a.createdAt);
        const likedPostIds = getLikedPostIds();

        feed.innerHTML = posts.map(post => {
            const char = findCharacter(post.characterId);
            if (!char) return '';
            const liked = likedPostIds.includes(post.id);
            return `
                <article class="card">
                    <div class="post-head">
                        <img class="avatar" src="${char.avatar}" alt="avatar" />
                        <div>
                            <div style="font-weight: 800; font-size: 1.1rem;">${char.name}</div>
                            <div style="color:#7a7172; font-size: 0.9rem;">${hoursAgoLabel(post.createdAt)}</div>
                        </div>
                    </div>
                    ${post.text ? `<div class="post-body">${escapeHtml(post.text).replace(/\n/g, '<br>')}</div>` : ''}
                    ${post.image ? `<img class="post-image" src="${post.image}" alt="post-image" onclick="openImageViewer(this.src, 'Imagen de publicación')" />` : ''}
                    <div class="post-actions">
                        <button type="button" class="post-action-btn ${liked ? 'liked' : ''}" ${liked ? 'disabled' : ''} onclick="likePost('${post.id}')"><i class="${liked ? 'fa-solid' : 'fa-regular'} fa-heart"></i> ${post.likes ?? 0}</button>
                        <button type="button" class="post-action-btn" onclick="openCommentsModal('${post.id}')"><i class="fa-regular fa-comment"></i> ${post.comments ?? 0}</button>
                        <button type="button" class="post-action-btn" onclick="sharePost()"><i class="fa-solid fa-share-nodes"></i> Compartir</button>
                        ${USER_TYPE === 'admin' ? `<button type="button" class="post-action-btn delete" onclick="deletePost('${post.id}')"><i class="fa-regular fa-trash-can"></i> Eliminar</button>` : ''}
                    </div>
                </article>
            `;
        }).join('');
    }

    function renderProfiles() {
        const list = document.getElementById('profilesList');
        const characters = getCharacters();

        list.innerHTML = characters.map(char => `
            <div class="profile-row">
                <div class="profile-left">
                    <img class="avatar" src="${char.avatar}" alt="avatar" />
                    <div>
                        <div class="profile-name">${char.name}</div>
                        <div class="profile-user">${char.username}</div>
                        <div class="profile-bio">${escapeHtml(char.bio)}</div>
                    </div>
                </div>
                <button type="button" class="primary-btn" onclick="openProfileDetail('${char.id}')">Ver Perfil</button>
            </div>
        `).join('');
    }

    function openProfileDetail(profileId) {
        selectedProfileId = profileId;
        const char = findCharacter(profileId);
        if (!char) return;

        const posts = getPosts().filter(post => post.characterId === profileId).sort((a,b) => b.createdAt - a.createdAt);
        const mediaPosts = posts.filter(post => !!post.image);

        const likedPostIds = getLikedPostIds();
        const detail = document.getElementById('sectionPerfilDetalle');
        detail.innerHTML = `
            <div style="margin-bottom: 10px;">
                <button type="button" class="ghost-btn" onclick="openSection('perfiles')"><i class="fa-solid fa-arrow-left"></i> Volver a Perfiles</button>
            </div>

            <div class="card" style="margin-bottom: 12px;">
                <div class="profile-cover-wrap">
                    <img class="profile-cover" src="${char.banner}" alt="banner" />
                    ${USER_TYPE === 'admin' ? `<button type="button" class="profile-edit-btn" onclick="openEditProfileModal('${char.id}')"><i class="fa-solid fa-pen"></i> Editar Perfil</button>` : ''}
                </div>
                <div class="profile-top">
                    <img class="avatar" style="width:120px;height:120px;border-width:4px;" src="${char.avatar}" alt="avatar" />
                    <div>
                        <div class="profile-name" style="font-size:1.6rem;">${char.name}</div>
                        <div class="profile-user" style="font-size:1rem;">${char.username}</div>
                        <div style="margin-top:8px;font-size:1rem;">${escapeHtml(char.bio)}</div>
                        <div class="profile-meta" style="margin-top:8px;display:flex;gap:22px;color:#7a7172;font-size:0.9rem;">
                            <span><strong style="color:#443C3D;">${char.followers ?? 0}</strong> Seguidores</span>
                            <span><strong style="color:#443C3D;">${char.following ?? 0}</strong> Siguiendo</span>
                            <span>Se unió en ${char.joined ?? '-'}</span>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <button id="tabPosts" class="active" onclick="switchDetailTab('posts')">Posts</button>
                    <button id="tabMedia" onclick="switchDetailTab('media')">Multimedia</button>
                </div>

                <div id="detailPosts" style="padding: 12px;">
                    ${posts.length ? posts.map(post => {
                        const liked = likedPostIds.includes(post.id);
                        return `
                        <article class="card">
                            <div class="post-head">
                                <img class="avatar" src="${char.avatar}" alt="avatar" />
                                <div>
                                    <div style="font-weight:800; font-size:1.1rem;">${char.name}</div>
                                    <div style="color:#7a7172; font-size:0.9rem;">${hoursAgoLabel(post.createdAt)}</div>
                                </div>
                            </div>
                            ${post.text ? `<div class="post-body">${escapeHtml(post.text).replace(/\n/g, '<br>')}</div>` : ''}
                            ${post.image ? `<img class="post-image" src="${post.image}" alt="post-image" onclick="openImageViewer(this.src, 'Imagen de publicación')" />` : ''}
                            <div class="post-actions">
                                <button type="button" class="post-action-btn ${liked ? 'liked' : ''}" ${liked ? 'disabled' : ''} onclick="likePost('${post.id}')"><i class="${liked ? 'fa-solid' : 'fa-regular'} fa-heart"></i> ${post.likes ?? 0}</button>
                                <button type="button" class="post-action-btn" onclick="openCommentsModal('${post.id}')"><i class="fa-regular fa-comment"></i> ${post.comments ?? 0}</button>
                                <button type="button" class="post-action-btn" onclick="sharePost()"><i class="fa-solid fa-share-nodes"></i> Compartir</button>
                                ${USER_TYPE === 'admin' ? `<button type="button" class="post-action-btn delete" onclick="deletePost('${post.id}')"><i class="fa-regular fa-trash-can"></i> Eliminar</button>` : ''}
                            </div>
                        </article>
                    `;
                    }).join('') : '<div class="small" style="padding:14px;">Este personaje aún no tiene publicaciones.</div>'}
                </div>

                <div id="detailMedia" style="display:none;">
                    ${mediaPosts.length ? `<div class="gallery">${mediaPosts.map(post => `<img src="${post.image}" alt="media" onclick="openImageViewer(this.src, 'Imagen multimedia')">`).join('')}</div>` : '<div class="small" style="padding:14px;">No hay multimedia para mostrar.</div>'}
                </div>
            </div>
        `;

        openSection('perfilDetalle');
    }

    function switchDetailTab(tab) {
        const btnPosts = document.getElementById('tabPosts');
        const btnMedia = document.getElementById('tabMedia');
        const boxPosts = document.getElementById('detailPosts');
        const boxMedia = document.getElementById('detailMedia');
        if (!btnPosts || !btnMedia || !boxPosts || !boxMedia) return;

        const animatePanel = (panel, className) => {
            panel.classList.remove('tab-enter-left', 'tab-enter-right');
            panel.classList.add(className);
            setTimeout(() => panel.classList.remove(className), 220);
        };

        if (tab === 'posts') {
            btnPosts.classList.add('active');
            btnMedia.classList.remove('active');
            boxPosts.style.display = 'block';
            boxMedia.style.display = 'none';
            animatePanel(boxPosts, 'tab-enter-left');
        } else {
            btnPosts.classList.remove('active');
            btnMedia.classList.add('active');
            boxPosts.style.display = 'none';
            boxMedia.style.display = 'block';
            animatePanel(boxMedia, 'tab-enter-right');
        }
    }

    function rerenderPostContexts() {
        renderFeed();
        if (selectedProfileId && currentView === 'perfilDetalle') {
            openProfileDetail(selectedProfileId);
        }
        if (selectedPostId && currentView === 'postDetalle') {
            renderCommentsModal();
        }
    }

    function likePost(postId) {
        const likedPostIds = getLikedPostIds();
        if (likedPostIds.includes(postId)) return;

        const posts = getPosts();
        const index = posts.findIndex(item => item.id === postId);
        if (index === -1) return;

        posts[index] = {
            ...posts[index],
            likes: Math.max(0, Number(posts[index].likes || 0)) + 1,
        };

        likedPostIds.push(postId);
        setLikedPostIds(likedPostIds);
        setPosts(posts);
        rerenderPostContexts();
    }

    async function deletePost(postId) {
        if (USER_TYPE !== 'admin') return;
        if (!confirm('¿Seguro que deseas eliminar esta publicación?')) return;

        const currentPosts = getPosts();
        const targetPost = currentPosts.find(item => item.id === postId);
        if (!targetPost) return;

        if (targetPost.dbId) {
            try {
                await deletePostInDatabase(targetPost.dbId);
            } catch (error) {
                alert(error.message || 'No se pudo eliminar en la base de datos.');
                return;
            }
        }

        const posts = currentPosts.filter(item => item.id !== postId);
        setPosts(posts);

        const likedPostIds = getLikedPostIds().filter(id => id !== postId);
        setLikedPostIds(likedPostIds);

        if (selectedPostId === postId) {
            selectedPostId = null;
            openSection('inicio');
        }

        rerenderPostContexts();
    }

    function sharePost() {
        alert('Compartir: Funcionalidad en desarrollo.');
    }

    function closeCommentsModal() {
        selectedPostId = null;
        openSection('inicio');
    }

    function openCommentsModal(postId) {
        selectedPostId = postId;
        renderCommentsModal();
        openSection('postDetalle');
    }

    function renderCommentsModal() {
        const post = findPost(selectedPostId);
        if (!post) return;

        const author = findCharacter(post.characterId);
        const container = document.getElementById('sectionPostDetalle');
        if (!container) return;

        const comments = Array.isArray(post.commentsList) ? post.commentsList : [];

        container.innerHTML = `
            <div style="margin-bottom: 10px;">
                <button type="button" class="ghost-btn" onclick="closeCommentsModal()"><i class="fa-solid fa-arrow-left"></i> Volver</button>
            </div>

            <div class="card" style="margin-bottom: 12px;">
                <div class="post-head">
                    <img class="avatar" src="${author?.avatar || ''}" alt="avatar" />
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem;">${escapeHtml(author?.name || 'Autor')}</div>
                        <div style="color:#7a7172; font-size: 0.9rem;">${hoursAgoLabel(post.createdAt)}</div>
                    </div>
                </div>
                ${post.text ? `<div class="post-body">${escapeHtml(post.text).replace(/\n/g, '<br>')}</div>` : ''}
                ${post.image ? `<img class="post-image" src="${post.image}" alt="post-image" onclick="openImageViewer(this.src, 'Imagen de publicación')" />` : ''}
                <div class="post-actions">
                    <button type="button" class="post-action-btn ${hasLikedPost(post.id) ? 'liked' : ''}" ${hasLikedPost(post.id) ? 'disabled' : ''} onclick="likePost('${post.id}')"><i class="${hasLikedPost(post.id) ? 'fa-solid' : 'fa-regular'} fa-heart"></i> ${post.likes ?? 0}</button>
                    <button type="button" class="post-action-btn" onclick="openCommentsModal('${post.id}')"><i class="fa-regular fa-comment"></i> ${post.comments ?? 0}</button>
                    <button type="button" class="post-action-btn" onclick="sharePost()"><i class="fa-solid fa-share-nodes"></i> Compartir</button>
                    ${USER_TYPE === 'admin' ? `<button type="button" class="post-action-btn delete" onclick="deletePost('${post.id}')"><i class="fa-regular fa-trash-can"></i> Eliminar</button>` : ''}
                </div>
            </div>

            <div class="card" style="padding: 12px;">
                <h3 style="font-size: 2rem; font-weight: 800; margin-bottom: 8px;">Comentarios (${comments.length})</h3>
                <div id="commentsList" class="comments-list"></div>
                ${USER_TYPE === 'admin' ? `
                    <div class="card" style="margin-top: 12px; padding: 12px;">
                        <label style="font-weight:700; font-size: 1rem;">Comentar como:</label>
                        <select class="select" id="commentCharacter"></select>

                        <div style="margin-top: 10px;">
                            <label style="font-weight:700; font-size: 1rem;">Mensaje</label>
                            <textarea class="textarea" id="commentText" placeholder="Escribe un comentario..."></textarea>
                        </div>

                        <div style="margin-top: 10px;">
                            <label style="font-weight:700; font-size: 1rem;"><i class="fa-regular fa-image"></i> Imagen o GIF (opcional)</label>
                            <input class="hidden-file-input" type="file" id="commentImage" accept="image/*" onchange="updateImagePreview('commentImage', 'commentImageZone', 'commentImagePreview')" />
                            <div class="upload-zone" id="commentImageZone" onclick="triggerFileInput('commentImage')" style="min-height: 110px;">
                                <img id="commentImagePreview" class="upload-preview" alt="Vista previa comentario">
                                <div class="upload-zone-content">
                                    <i class="fa-regular fa-image"></i>
                                    <div class="upload-zone-title">Haz clic para subir imagen o GIF</div>
                                    <div class="upload-zone-sub">PNG · JPG · GIF · WEBP</div>
                                </div>
                            </div>
                        </div>

                        <div style="display:flex; justify-content:flex-end; margin-top: 10px;">
                            <button type="button" class="primary-btn" onclick="publishComment()"><i class="fa-solid fa-paper-plane"></i> Enviar</button>
                        </div>
                    </div>
                ` : ''}
            </div>
        `;

        const list = document.getElementById('commentsList');
        if (!list) return;
        list.innerHTML = comments.length > 0
            ? comments.map(comment => {
                const char = findCharacter(comment.characterId);
                return `
                    <div class="comment-item">
                        <div class="comment-head">
                            <div class="comment-head-main">
                                <img class="comment-avatar" src="${char?.avatar || ''}" alt="avatar" />
                                <div>
                                    <div style="font-weight:800;">${escapeHtml(char?.name || 'Usuario')}</div>
                                    <div class="small">${hoursAgoLabel(comment.createdAt)}</div>
                                </div>
                            </div>
                            ${USER_TYPE === 'admin' ? `<button type="button" class="comment-delete-btn" onclick="deleteComment('${comment.id}')"><i class="fa-regular fa-trash-can"></i> Eliminar</button>` : ''}
                        </div>
                        <div>${escapeHtml(comment.text).replace(/\n/g, '<br>')}</div>
                        ${comment.image ? `<img class="comment-media" src="${comment.image}" alt="comment-image" onclick="openImageViewer(this.src, 'Imagen de comentario')" />` : ''}
                    </div>
                `;
            }).join('')
            : '<div class="small">Este post aún no tiene comentarios.</div>';

        if (USER_TYPE === 'admin') {
            const select = document.getElementById('commentCharacter');
            if (select) {
                const chars = getCharacters();
                select.innerHTML = chars.map(char => `<option value="${char.id}">${char.name} (${char.username})</option>`).join('');
            }
            const commentText = document.getElementById('commentText');
            if (commentText) commentText.value = '';
            const commentImage = document.getElementById('commentImage');
            if (commentImage) commentImage.value = '';
            clearImagePreview('commentImageZone', 'commentImagePreview');
        }
    }

    async function publishComment() {
        if (USER_TYPE !== 'admin') return;
        if (!selectedPostId) return;

        const select = document.getElementById('commentCharacter');
        const input = document.getElementById('commentText');
        const imageInput = document.getElementById('commentImage');
        if (!select || !input) return;

        const characterId = select.value;
        const text = input.value.trim();
        const imageFile = imageInput?.files?.[0] ?? null;
        if (!characterId || (!text && !imageFile)) {
            alert('Selecciona personaje y agrega texto, imagen o ambos.');
            return;
        }

        let image = '';
        if (imageFile) image = await fileToDataURL(imageFile);

        const posts = getPosts();
        const index = posts.findIndex(item => item.id === selectedPostId);
        if (index === -1) return;

        const commentCharacter = findCharacter(characterId);
        if (!commentCharacter) {
            alert('No se encontró el perfil seleccionado para comentar.');
            return;
        }

        if (!posts[index].dbId) {
            const postCharacter = findCharacter(posts[index].characterId);
            if (!postCharacter) {
                alert('No se encontró el autor del post para guardarlo en base de datos.');
                return;
            }

            try {
                const postResult = await savePostInDatabase({
                    text: posts[index].text || '',
                    image: posts[index].image || '',
                    character: {
                        db_id: postCharacter.dbId ?? null,
                        name: postCharacter.name,
                        username: postCharacter.username,
                        bio: postCharacter.bio,
                        avatar: postCharacter.avatar,
                        banner: postCharacter.banner,
                    },
                });
                posts[index].dbId = postResult?.post?.id ?? null;
            } catch (error) {
                alert(error.message || 'No se pudo preparar el post en la base de datos para guardar comentarios.');
                return;
            }
        }

        let dbCommentId = null;
        try {
            const commentResult = await saveCommentInDatabase(posts[index].dbId, {
                comment: text,
                image,
                character: {
                    db_id: commentCharacter.dbId ?? null,
                    name: commentCharacter.name,
                    username: commentCharacter.username,
                    bio: commentCharacter.bio,
                    avatar: commentCharacter.avatar,
                    banner: commentCharacter.banner,
                },
            });
            dbCommentId = commentResult?.comment?.id ?? null;
        } catch (error) {
            alert(error.message || 'No se pudo guardar el comentario en la base de datos.');
            return;
        }

        const commentsList = Array.isArray(posts[index].commentsList) ? [...posts[index].commentsList] : [];
        commentsList.push({
            id: dbCommentId ? `comment-db-${dbCommentId}` : `comment-${Date.now()}`,
            dbId: dbCommentId,
            characterId,
            text,
            image,
            createdAt: Date.now(),
        });

        posts[index] = {
            ...posts[index],
            commentsList,
            comments: commentsList.length,
        };

        setPosts(posts);
        renderCommentsModal();
        rerenderPostContexts();
    }

    function openPostModal() {
        if (USER_TYPE !== 'admin') return;
        const chars = getCharacters();
        const select = document.getElementById('postCharacter');
        if (!select) return;
        select.innerHTML = chars.map(char => `<option value="${char.id}">${char.name} (${char.username})</option>`).join('');
        const postText = document.getElementById('postText');
        const postImage = document.getElementById('postImage');
        if (!postText || !postImage) return;
        postText.value = '';
        postImage.value = '';
        clearImagePreview('postImageZone', 'postImagePreview');
        const postModal = document.getElementById('postModal');
        if (!postModal) return;
        postModal.classList.add('active');
    }

    function closePostModal() {
        const postModal = document.getElementById('postModal');
        if (!postModal) return;
        postModal.classList.remove('active');
    }

    function openProfileModal() {
        if (USER_TYPE !== 'admin') return;
        document.getElementById('profileName').value = '';
        document.getElementById('profileUsername').value = '';
        document.getElementById('profileBio').value = '';
        document.getElementById('profileAvatar').value = '';
        document.getElementById('profileBanner').value = '';
        clearImagePreview('profileAvatarZone', 'profileAvatarPreview');
        clearImagePreview('profileBannerZone', 'profileBannerPreview');
        document.getElementById('profileModal').classList.add('active');
    }

    function closeProfileModal() { document.getElementById('profileModal').classList.remove('active'); }

    function openEditProfileModal(profileId) {
        if (USER_TYPE !== 'admin') return;
        const char = findCharacter(profileId);
        if (!char) return;

        editingProfileId = profileId;
        document.getElementById('editProfileName').value = char.name || '';
        document.getElementById('editProfileUsername').value = char.username || '';
        document.getElementById('editProfileBio').value = char.bio || '';
        document.getElementById('editProfileAvatar').value = '';
        document.getElementById('editProfileBanner').value = '';

        setImagePreviewFromUrl('editProfileAvatarZone', 'editProfileAvatarPreview', char.avatar);
        setImagePreviewFromUrl('editProfileBannerZone', 'editProfileBannerPreview', char.banner);

        document.getElementById('editProfileModal').classList.add('active');
    }

    function closeEditProfileModal() {
        editingProfileId = null;
        document.getElementById('editProfileModal').classList.remove('active');
    }

    function fileToDataURL(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    function triggerFileInput(inputId) {
        const input = document.getElementById(inputId);
        if (input) input.click();
    }

    async function updateImagePreview(inputId, zoneId, previewId) {
        const input = document.getElementById(inputId);
        const zone = document.getElementById(zoneId);
        const preview = document.getElementById(previewId);
        if (!input || !zone || !preview) return;

        const file = input.files?.[0];
        if (!file) {
            clearImagePreview(zoneId, previewId);
            return;
        }

        const dataUrl = await fileToDataURL(file);
        preview.src = dataUrl;
        zone.classList.add('has-preview');
    }

    function clearImagePreview(zoneId, previewId) {
        const zone = document.getElementById(zoneId);
        const preview = document.getElementById(previewId);
        if (!zone || !preview) return;
        preview.removeAttribute('src');
        zone.classList.remove('has-preview');
    }

    function setImagePreviewFromUrl(zoneId, previewId, imageUrl) {
        const zone = document.getElementById(zoneId);
        const preview = document.getElementById(previewId);
        if (!zone || !preview) return;

        if (!imageUrl) {
            clearImagePreview(zoneId, previewId);
            return;
        }

        preview.src = imageUrl;
        zone.classList.add('has-preview');
    }

    async function savePostInDatabase(payload) {
        const response = await fetch('/social/posts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify(payload),
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo guardar el post en la base de datos.');
        }

        return data;
    }

    async function deletePostInDatabase(dbPostId) {
        const response = await fetch(`/social/posts/${dbPostId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo eliminar el post en la base de datos.');
        }
    }

    async function createProfileInDatabase(payload) {
        const response = await fetch('/social/profiles', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify(payload),
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo crear el perfil en la base de datos.');
        }

        return data;
    }

    async function updateProfileInDatabase(dbProfileId, payload) {
        const response = await fetch(`/social/profiles/${dbProfileId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify(payload),
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo actualizar el perfil en la base de datos.');
        }

        return data;
    }

    async function deleteProfileInDatabase(dbProfileId) {
        const response = await fetch(`/social/profiles/${dbProfileId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo eliminar el perfil en la base de datos.');
        }
    }

    async function saveCommentInDatabase(dbPostId, payload) {
        const response = await fetch(`/social/posts/${dbPostId}/comments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify(payload),
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo guardar el comentario en la base de datos.');
        }

        return data;
    }

    async function deleteCommentInDatabase(dbCommentId) {
        const response = await fetch(`/social/comments/${dbCommentId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
        });

        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data?.message || 'No se pudo eliminar el comentario en la base de datos.');
        }
    }

    async function deleteComment(commentId) {
        if (USER_TYPE !== 'admin') return;
        if (!selectedPostId) return;
        if (!confirm('¿Seguro que deseas eliminar este comentario?')) return;

        const posts = getPosts();
        const postIndex = posts.findIndex(item => item.id === selectedPostId);
        if (postIndex === -1) return;

        const commentsList = Array.isArray(posts[postIndex].commentsList) ? [...posts[postIndex].commentsList] : [];
        const commentIndex = commentsList.findIndex(item => String(item.id) === String(commentId));
        if (commentIndex === -1) return;

        const targetComment = commentsList[commentIndex];
        if (targetComment.dbId) {
            try {
                await deleteCommentInDatabase(targetComment.dbId);
            } catch (error) {
                alert(error.message || 'No se pudo eliminar el comentario en la base de datos.');
                return;
            }
        }

        commentsList.splice(commentIndex, 1);

        posts[postIndex] = {
            ...posts[postIndex],
            commentsList,
            comments: commentsList.length,
        };

        setPosts(posts);
        renderCommentsModal();
        rerenderPostContexts();
    }

    async function publishPost() {
        if (USER_TYPE !== 'admin') return;
        const characterId = document.getElementById('postCharacter').value;
        const text = document.getElementById('postText').value.trim();
        const imageFile = document.getElementById('postImage').files[0];
        const character = findCharacter(characterId);

        if (!text && !imageFile) {
            alert('Debes escribir texto o subir una imagen para publicar.');
            return;
        }

        if (!character) {
            alert('No se encontró el perfil seleccionado para publicar.');
            return;
        }

        let image = '';
        if (imageFile) image = await fileToDataURL(imageFile);

        let dbPostId = null;
        try {
            const dbResult = await savePostInDatabase({
                text,
                image,
                character: {
                    db_id: character.dbId ?? null,
                    name: character.name,
                    username: character.username,
                    bio: character.bio,
                    avatar: character.avatar,
                    banner: character.banner,
                },
            });
            dbPostId = dbResult?.post?.id ?? null;
        } catch (error) {
            alert(error.message || 'No se pudo guardar el post en la base de datos.');
            return;
        }

        const posts = getPosts();
        posts.push({ id: `post-${Date.now()}`, dbId: dbPostId, characterId, text, image, createdAt: Date.now(), likes: 0, comments: 0, commentsList: [] });
        setPosts(posts);
        closePostModal();
        renderFeed();
        if (selectedProfileId === characterId && currentView === 'perfilDetalle') openProfileDetail(characterId);
    }

    async function createProfile() {
        if (USER_TYPE !== 'admin') return;

        const name = document.getElementById('profileName').value.trim();
        const username = document.getElementById('profileUsername').value.trim();
        const bio = document.getElementById('profileBio').value.trim();
        const avatarFile = document.getElementById('profileAvatar').files[0];
        const bannerFile = document.getElementById('profileBanner').files[0];

        if (!name || !username || !bio || !avatarFile || !bannerFile) {
            alert('Completa todos los campos obligatorios y sube avatar/banner.');
            return;
        }

        const [avatar, banner] = await Promise.all([fileToDataURL(avatarFile), fileToDataURL(bannerFile)]);
        let createdDbProfile = null;
        try {
            const dbResult = await createProfileInDatabase({
                name,
                username,
                bio,
                avatar,
                banner,
            });
            createdDbProfile = dbResult?.profile ?? null;
        } catch (error) {
            alert(error.message || 'No se pudo crear el perfil en la base de datos.');
            return;
        }

        const chars = getCharacters();
        chars.push({
            id: `char-${Date.now()}`,
            dbId: createdDbProfile?.id ?? null,
            name: createdDbProfile?.name ?? name,
            username: createdDbProfile?.username ?? (username.startsWith('@') ? username : `@${username}`),
            bio: createdDbProfile?.bio ?? bio,
            avatar: createdDbProfile?.avatar ?? avatar,
            banner: createdDbProfile?.banner ?? banner,
            followers: 0,
            following: 0,
            joined: new Date().toLocaleString('es-ES', { month: 'long', year: 'numeric' })
        });
        setCharacters(chars);

        closeProfileModal();
        renderProfiles();
        openSection('perfiles');
    }

    async function saveProfileChanges() {
        if (USER_TYPE !== 'admin' || !editingProfileId) return;

        const name = document.getElementById('editProfileName').value.trim();
        const username = document.getElementById('editProfileUsername').value.trim();
        const bio = document.getElementById('editProfileBio').value.trim();
        const avatarFile = document.getElementById('editProfileAvatar').files[0];
        const bannerFile = document.getElementById('editProfileBanner').files[0];

        if (!name || !username || !bio) {
            alert('Nombre, usuario y biografía son obligatorios.');
            return;
        }

        const chars = getCharacters();
        const index = chars.findIndex(item => item.id === editingProfileId);
        if (index === -1) return;

        let avatar = chars[index].avatar;
        let banner = chars[index].banner;

        if (avatarFile) avatar = await fileToDataURL(avatarFile);
        if (bannerFile) banner = await fileToDataURL(bannerFile);

        const normalizedUsername = username.startsWith('@') ? username : `@${username}`;

        if (chars[index].dbId) {
            try {
                await updateProfileInDatabase(chars[index].dbId, {
                    name,
                    username: normalizedUsername,
                    bio,
                    avatar,
                    banner,
                });
            } catch (error) {
                alert(error.message || 'No se pudo actualizar el perfil en la base de datos.');
                return;
            }
        }

        chars[index] = {
            ...chars[index],
            name,
            username: normalizedUsername,
            bio,
            avatar,
            banner,
        };

        setCharacters(chars);
        closeEditProfileModal();
        renderProfiles();
        renderFeed();
        renderComposerAvatar();
        openProfileDetail(chars[index].id);
    }

    async function deleteProfile() {
        if (USER_TYPE !== 'admin' || !editingProfileId) return;
        if (!confirm('¿Seguro que deseas eliminar este perfil y sus publicaciones?')) return;

        const targetCharacter = getCharacters().find(item => item.id === editingProfileId);
        if (!targetCharacter) return;

        if (targetCharacter.dbId) {
            try {
                await deleteProfileInDatabase(targetCharacter.dbId);
            } catch (error) {
                alert(error.message || 'No se pudo eliminar el perfil en la base de datos.');
                return;
            }
        }

        const chars = getCharacters().filter(item => item.id !== editingProfileId);
        const posts = getPosts().filter(post => post.characterId !== editingProfileId);

        setCharacters(chars);
        setPosts(posts);

        selectedProfileId = null;
        closeEditProfileModal();
        renderProfiles();
        renderFeed();
        renderComposerAvatar();
        openSection('perfiles');
    }

    function escapeHtml(str) {
        return str
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#39;');
    }

    function minimizeWindow() {
        sendSocialMessage('focus');
        sendSocialMessage('minimize', { mode: isMaximized ? 'maximized' : 'floating' });
    }

    function applyFloatingDefaults() {
        const appWindow = document.getElementById('socialWindow');
        const safeWidth = Math.max(MIN_WIDTH, Math.floor(window.innerWidth * 0.9));
        const safeHeight = Math.max(MIN_HEIGHT, Math.floor((window.innerHeight - 72) * 0.84));

        isMaximized = false;
        appWindow.classList.remove('maximized');
        appWindow.style.display = 'flex';
        appWindow.style.position = 'fixed';
        appWindow.style.width = safeWidth + 'px';
        appWindow.style.height = safeHeight + 'px';
        appWindow.style.top = Math.max(0, Math.floor((window.innerHeight - 72 - safeHeight) / 2)) + 'px';
        appWindow.style.left = '50%';
        appWindow.style.right = 'auto';
        appWindow.style.bottom = 'auto';
        appWindow.style.transform = 'translateX(-50%)';
        appWindow.style.borderRadius = '1rem';
        appWindow.style.resize = 'both';

        const btn = document.getElementById('maxBtn');
        if (btn) btn.innerHTML = '<i class="fa-regular fa-square"></i>';
    }

    function applyMaximizedDefaults() {
        const appWindow = document.getElementById('socialWindow');
        isMaximized = true;
        appWindow.classList.add('maximized');
        appWindow.style.display = 'flex';
        appWindow.style.position = 'fixed';
        appWindow.style.width = '100%';
        appWindow.style.height = 'calc(100vh - 72px)';
        appWindow.style.top = '0';
        appWindow.style.left = '0';
        appWindow.style.right = 'auto';
        appWindow.style.bottom = 'auto';
        appWindow.style.transform = 'none';
        appWindow.style.borderRadius = '0';
        appWindow.style.resize = 'none';

        const btn = document.getElementById('maxBtn');
        if (btn) btn.innerHTML = '<i class="fa-regular fa-window-restore"></i>';
    }

    function clampWindowIntoViewport() {
        if (isMaximized) return;
        const appWindow = document.getElementById('socialWindow');
        const rect = appWindow.getBoundingClientRect();
        let left = rect.left;
        let top = rect.top;
        const maxLeft = Math.max(0, window.innerWidth - rect.width);
        const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);

        left = Math.max(0, Math.min(left, maxLeft));
        top = Math.max(0, Math.min(top, maxTop));

        appWindow.style.left = left + 'px';
        appWindow.style.top = top + 'px';
        appWindow.style.transform = 'none';
    }

    function toggleMaximize() {
        sendSocialMessage('focus');
        isMaximized = !isMaximized;
        if (isMaximized) {
            applyMaximizedDefaults();
            sendSocialMessage('maximize');
        } else {
            applyFloatingDefaults();
            sendSocialMessage('restore');
        }
    }

    function closeWindow() {
        sendSocialMessage('focus');
        sendSocialMessage('close');
    }

    window.addEventListener('message', (event) => {
        if (!event.data || !event.data.type) return;
        if (event.data.app && event.data.app !== 'social') return;

        if (event.data.type === 'openFloating') {
            applyFloatingDefaults();
        } else if (event.data.type === 'openMaximized') {
            applyMaximizedDefaults();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeImageViewer();
        }
    });

    (function setupDragResize() {
        const appWindow = document.getElementById('socialWindow');
        const header = appWindow.querySelector('.window-header');
        const resizeHandle = document.createElement('div');
        resizeHandle.className = 'resize-handle';
        appWindow.appendChild(resizeHandle);

        let dragging = false;
        let resizing = false;
        let offsetX = 0;
        let offsetY = 0;
        let startX = 0;
        let startY = 0;
        let startW = 0;
        let startH = 0;

        header.addEventListener('mousedown', (e) => {
            if (e.target.closest('.window-controls') || isMaximized) return;
            dragging = true;
            sendSocialMessage('focus');
            const rect = appWindow.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;
        });

        resizeHandle.addEventListener('mousedown', (e) => {
            e.stopPropagation();
            if (isMaximized) return;
            resizing = true;
            sendSocialMessage('focus');
            const rect = appWindow.getBoundingClientRect();
            startX = e.clientX;
            startY = e.clientY;
            startW = rect.width;
            startH = rect.height;
        });

        document.addEventListener('mousemove', (e) => {
            if (dragging) {
                const rect = appWindow.getBoundingClientRect();
                const maxLeft = Math.max(0, window.innerWidth - rect.width);
                const maxTop = Math.max(0, (window.innerHeight - 72) - rect.height);
                const left = Math.max(0, Math.min(e.clientX - offsetX, maxLeft));
                const top = Math.max(0, Math.min(e.clientY - offsetY, maxTop));
                appWindow.style.left = left + 'px';
                appWindow.style.top = top + 'px';
                appWindow.style.transform = 'none';
            }

            if (resizing) {
                const rect = appWindow.getBoundingClientRect();
                const maxWidth = Math.max(MIN_WIDTH, window.innerWidth - rect.left);
                const maxHeight = Math.max(MIN_HEIGHT, (window.innerHeight - 72) - rect.top);
                const width = Math.min(maxWidth, Math.max(MIN_WIDTH, startW + (e.clientX - startX)));
                const height = Math.min(maxHeight, Math.max(MIN_HEIGHT, startH + (e.clientY - startY)));
                appWindow.style.width = width + 'px';
                appWindow.style.height = height + 'px';
            }
        });

        document.addEventListener('mouseup', () => {
            dragging = false;
            resizing = false;
        });

        appWindow.addEventListener('mousedown', () => sendSocialMessage('focus'));
    })();

    window.addEventListener('resize', clampWindowIntoViewport);

    function bootstrapSocial() {
        renderComposerAvatar();
        renderFeed();
        renderProfiles();
        applyFloatingDefaults();

        document.getElementById('postImage')?.addEventListener('change', () => {
            updateImagePreview('postImage', 'postImageZone', 'postImagePreview');
        });

        document.getElementById('profileAvatar')?.addEventListener('change', () => {
            updateImagePreview('profileAvatar', 'profileAvatarZone', 'profileAvatarPreview');
        });

        document.getElementById('profileBanner')?.addEventListener('change', () => {
            updateImagePreview('profileBanner', 'profileBannerZone', 'profileBannerPreview');
        });

        document.getElementById('editProfileAvatar')?.addEventListener('change', () => {
            updateImagePreview('editProfileAvatar', 'editProfileAvatarZone', 'editProfileAvatarPreview');
        });

        document.getElementById('editProfileBanner')?.addEventListener('change', () => {
            updateImagePreview('editProfileBanner', 'editProfileBannerZone', 'editProfileBannerPreview');
        });
    }

    bootstrapSocial();

    window.RedSocialApp = {
        openFloating: applyFloatingDefaults,
        openMaximized: applyMaximizedDefaults,
    };
</script>
