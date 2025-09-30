<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Name Picker & Prize Draw Generator ✨</title>
    <link rel="icon" href="icon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #5d5dff;
            --secondary-color: #8c7ae6;
            --bg-dark: #1a232f;
            --text-light: #f5f6fa;
            --text-dark: #bdc3c7;
            --card-bg: #2c3e50;
            --card-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            --text-section2-dark: #f5f6fa;
            --text-section2-light: #34495e;
            --modal-bg: rgba(0, 0, 0, 0.7);
            --modal-card-bg: #1a232f;
            --modal-card-bg-light: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--bg-dark);
            color: var(--text-dark);
            transition: background .5s ease-in-out, color .5s ease-in-out;
            overflow-y: auto;
            scrollbar-width: none;
        }

        body::-webkit-scrollbar {
            display: none;
        }
        
        body.light-mode {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            color: #34495e;
        }
        
        body.light-mode p {
            color: #7f8c8d;
        }

        .container {
            padding: 4em;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            text-align: center;
            width: 90%;
            max-width: 1200px;
            box-sizing: border-box;
            background-color: var(--card-bg);
            animation: fadeIn .8s ease-in-out;
        }
        
        body.light-mode .container {
            background-color: #ffffff;
            color: #34495e;
        }
        
        #section2.container {
            background: none;
            box-shadow: none;
            max-width: 100%;
            width: 100vw;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            color: var(--text-section2-dark);
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            position: relative;
            overflow-y: auto;
            scrollbar-width: none;
        }
        
        body.light-mode #section2.container {
            color: var(--text-section2-light);
            text-shadow: none;
        }
        
        /* Perbaikan CSS: Aturan background untuk section2 */
        #section2.container.has-background {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        /* Perbaikan CSS: Latar belakang section2 saat light mode tanpa gambar */
        body.light-mode #section2.container:not(.has-background) {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }
        /* Latar belakang section2 saat dark mode tanpa gambar (default) */
        #section2.container:not(.has-background) {
            background-color: var(--bg-dark);
        }
        
        h1 {
            font-size: 2.5em;
            margin-bottom: .5em;
            font-weight: 700;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 2em;
        }
        
        @media (min-width: 768px) {
            .input-group {
                flex-direction: row;
                gap: 25px;
                align-items: flex-start;
            }
        }

        textarea {
            width: 100%;
            min-height: 250px;
            padding: 18px;
            border: 1px solid #44596e;
            border-radius: 12px;
            font-size: 16px;
            resize: none;
            box-sizing: border-box;
            transition: border-color .3s ease, box-shadow .3s ease, background-color .5s ease, color .5s ease;
            background-color: #34495e;
            color: var(--text-light);
        }
        
        textarea::placeholder {
            color: #7f8c8d;
        }
        
        body.light-mode textarea {
            background-color: #f9f9f9;
            border-color: #e0e0e0;
            color: #34495e;
        }
        
        body.light-mode textarea::placeholder {
            color: #a0a0a0;
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(93, 93, 255, 0.3);
        }

        #names-input-container {
            flex: 1;
        }
        
        #preview-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #background-preview {
            width: 100%;
            aspect-ratio: 16/9;
            height: auto;
            border-radius: 12px;
            border: 2px dashed #556b82;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            font-size: .9em;
            color: #bdc3c7;
            background-color: #34495e;
            transition: background-color .5s ease;
        }
        
        body.light-mode #background-preview {
            background-color: #f8f9fa;
            border-color: #b2c2b2;
            color: #a0a0a0;
        }

        .button {
            display: inline-block;
            padding: 14px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            color: white;
            background: linear-gradient(45deg, #7f8c8d, #95a5a6);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all .3s ease;
            margin: .5em;
            text-decoration: none;
            white-space: nowrap;
        }

        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .button.primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 6px 15px rgba(93, 93, 255, 0.3);
        }

        .button.primary:hover {
            background: linear-gradient(45deg, #4b4bdf, #7966d9);
            box-shadow: 0 8px 20px rgba(93, 93, 255, 0.4);
        }
        
        .button.danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.3);
        }
        .button.danger:hover {
            background: linear-gradient(45deg, #c0392b, #a83227);
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
        }
        
        .button-group {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }
        
        #toggle-mode-button {
            background: none;
            color: var(--text-dark);
            box-shadow: none;
            border: 1px solid var(--text-dark);
            transition: color .5s ease, border-color .5s ease;
        }
        
        body.light-mode #toggle-mode-button {
            color: #34495e;
            border: 1px solid #34495e;
        }

        .language-dropdown-container {
            position: relative;
            display: inline-block;
            margin: .5em;
        }

        #language-button {
            background-color: var(--card-bg);
            color: var(--text-dark);
            border: 1px solid #7f8c8d;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 8px;
            transition: all .3s ease;
            font-size: 1.1em;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        body.light-mode #language-button {
            background-color: #f9f9f9;
            color: #34495e;
            border-color: #e0e0e0;
        }
        #language-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        #language-menu {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: 10px;
            background-color: var(--card-bg);
            border: 1px solid #7f8c8d;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            transition: all .3s ease;
            min-width: 200px;
            text-align: left;
            max-height: 250px;
            overflow-y: auto;
        }
        .language-dropdown-container.active #language-menu {
            opacity: 1;
            visibility: visible;
            bottom: 105%;
        }
        body.light-mode #language-menu {
            background-color: #ffffff;
            border-color: #e0e0e0;
        }

        .language-menu-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color .2s ease;
            color: var(--text-dark);
            gap: 8px;
        }
        .language-menu-item:first-child { border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .language-menu-item:last-child { border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; }
        .language-menu-item:hover { background-color: rgba(255, 255, 255, 0.1); }
        body.light-mode .language-menu-item:hover { background-color: #f0f0f0; }

        .hidden { display: none !important; }

        #result {
            font-size: 40px;
            font-weight: bold;
            color: var(--text-section2-dark);
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            min-height: 1.5em;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            flex-grow: 1;
            padding: 1em;
            opacity: 1;
            transition: opacity .5s ease-in-out;
            text-align: center;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
        
        body.light-mode #result {
            color: var(--text-section2-light);
            text-shadow: none;
        }
        
        #result.shaking { animation: pulse .1s infinite; }
        
        #result.stopped { animation: none; transition: transform .5s cubic-bezier(0.68, -0.55, 0.27, 1.55), color .5s ease; }
        
        #result > p.initial-text {
            font-size: 32px;
            font-weight: normal;
            color: inherit;
            text-shadow: none;
        }

        .congratulations-text {
            color: #f1c40f;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: .5em;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            animation: celebrate 1.5s ease-in-out;
        }
        
        #winner-name {
            font-size: 40px;
            animation: zoomIn 1s ease-in-out;
            transition: font-size .5s ease;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        @media (min-width: 768px) {
            #result, #winner-name { font-size: 60px; }
            .congratulations-text { font-size: 40px; }
        }
        
        #section2 .button-group { margin-top: 20px; }
        
        #section2 > .button-group { position: relative; z-index: 20; }

        #crop-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: var(--modal-bg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 100;
        }
        
        #crop-container {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: move;
        }
        
        #crop-image { max-width: 100%; max-height: 100%; user-select: none; pointer-events: none; }
        
        #crop-box {
            position: absolute;
            width: 80%;
            height: auto;
            aspect-ratio: 16/9;
            border: 2px dashed #f1c40f;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.2);
            cursor: grab;
        }
        
        .resize-handle {
            position: absolute;
            width: 15px;
            height: 15px;
            background: var(--primary-color);
            border: 1px solid var(--text-light);
            border-radius: 50%;
        }
        
        .resize-handle.top-left { top: -8px; left: -8px; cursor: nw-resize; }
        .resize-handle.top-right { top: -8px; right: -8px; cursor: ne-resize; }
        .resize-handle.bottom-left { bottom: -8px; left: -8px; cursor: sw-resize; }
        .resize-handle.bottom-right { bottom: -8px; right: -8px; cursor: se-resize; }
        
        #crop-buttons {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        @keyframes celebrate { 0% { transform: scale(.5) rotate(0); opacity: 0; } 50% { transform: scale(1.1) rotate(5deg); opacity: 1; } 100% { transform: scale(1) rotate(0); } }
        @keyframes zoomIn { from { opacity: 0; } to { opacity: 1; } }

        #reshuffle-options {
            margin-top: 1em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: var(--text-dark);
        }
        body.light-mode #reshuffle-options { color: #34495e; }
        #reshuffle-options input { transform: scale(1.5); cursor: pointer; }
        
        .ad-container-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 2em;
            width: 100%;
        }
        .ad-container {
            text-align: center;
            overflow: hidden;
            display: none;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 300px;
            max-width: 728px;
        }
        .ad-container.show { display: flex; }

        @media (max-width: 767px) {
            .container { padding: 2em 1em; }
            h1 { font-size: 2em; }
            p { font-size: 1em; }
            .button { font-size: 1em; padding: 12px 20px; }
            #language-button { font-size: 1em; }
            .button-group { flex-direction: column; }
            #section2.container { padding: 20px 10px; box-sizing: border-box; height: auto; min-height: 100vh; overflow-y: auto; -webkit-overflow-scrolling: touch; justify-content: flex-start; }
            #result { font-size: 40px; padding: .5em; }
            .congratulations-text { font-size: 28px; }
            #winner-name { font-size: 36px; }
            #section2 > .button-group { flex-direction: row; justify-content: space-around; margin-top: 20px; position: relative; padding: 0; }
            #fullscreen-button { position: absolute; top: 20px; right: 20px; margin: 0; padding: 8px 15px; }
        }

        .custom-alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--modal-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity .3s ease, visibility .3s ease;
        }

        .custom-alert.show {
            opacity: 1;
            visibility: visible;
        }

        .custom-alert-content {
            background-color: var(--modal-card-bg);
            color: var(--text-light);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            max-width: 400px;
            text-align: center;
            transform: scale(0.9);
            transition: transform .3s ease;
        }
        
        body.light-mode .custom-alert-content {
            background-color: var(--modal-card-bg-light);
            color: var(--text-section2-light);
        }

        .custom-alert.show .custom-alert-content {
            transform: scale(1);
        }
        
        .custom-alert-content h3 {
            margin-top: 0;
            font-size: 1.5em;
        }

        .custom-alert-content p {
            margin-bottom: 20px;
            color: inherit;
        }
    </style>
</head>
<body>

    <div id="section1" class="container">
        <h1 data-i18n="title">Random Name Picker & Prize Draw Generator ✨</h1>
        <p data-i18n="description">Welcome to the free online name picker!</p>
        
        <div class="ad-container-wrapper" id="ad-wrapper">
            <div class="ad-container show" id="ad-banner-1">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,  
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
            </div>

        <div class="input-group">
            <div id="names-input-container">
                <p data-i18n="names_input_label">Enter Names (one per line):</p>
                <textarea id="names-input" data-i18n-placeholder="names_placeholder"></textarea>
            </div>
            <div id="preview-container">
                <p data-i18n="preview_title">Background Preview:</p>
                <div id="background-preview"></div>
            </div>
        </div>

        <div id="reshuffle-options">
            <input type="checkbox" id="include-winner-checkbox">
            <label for="include-winner-checkbox" data-i18n="include_winner_label">Include winner in next shuffle</label>
        </div>
        
        <div class="button-group">
            <label for="bg-upload" class="button" data-i18n="change_background">Change Background</label>
            <input type="file" id="bg-upload" accept="image/*" style="display:none;">
            <button id="delete-bg-button" class="button danger hidden" data-i18n="delete_background">Delete Background</button>
            <button id="start-transition-button" class="button primary" data-i18n="start">Start</button>
            <button id="toggle-mode-button" class="button" data-i18n="toggle_mode_light">Light Mode</button>
            <div class="language-dropdown-container">
                <button id="language-button">
                    <span id="language-flag">🇺🇸</span>
                    <span id="language-label">English</span>
                </button>
                <div id="language-menu">
                    <div class="language-menu-item" data-lang="en"><span>🇺🇸</span> English</div>
                    <div class="language-menu-item" data-lang="id"><span>🇮🇩</span> Bahasa Indonesia</div>
                </div>
            </div>
        </div>

        <div class="ad-container-wrapper" id="ad-wrapper">
            <div class="ad-container show" id="ad-banner-1">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,  
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
            <div class="ad-container show" id="ad-banner-2">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
            <div class="ad-container show" id="ad-banner-3">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
            <div class="ad-container show" id="ad-banner-4">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
            <div class="ad-container show" id="ad-banner-5">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
            <div class="ad-container show" id="ad-banner-6">
                <script type="text/javascript">
                    atOptions = {
                        'key' : 'xxxxxxxx',
                        'format' : 'iframe',
                        'height' : 90,
                        'width' : 728,
                        'params' : {}
                    };
                    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitableadcontent.com/xxxxxxxx/invoke.js"></scr' + 'ipt>');
                </script>
            </div>
        </div>
    </div>

    <div id="section2" class="container hidden">
        <button id="fullscreen-button" class="button" data-i18n="fullscreen">Fullscreen</button>
        <div id="result">
            <p class="initial-text" data-i18n="initial_text">Press 'Start Shuffle' to pick a winner!</p>
        </div>
        <div class="button-group">
            <button id="back-button" class="button" data-i18n="back">Back</button>
            <button id="start-button" class="button primary" data-i18n="start_shuffle">Start Shuffle</button>
            <button id="start-again-button" class="button primary hidden" data-i18n="start_again">Shuffle Again</button>
        </div>
    </div>
    
    <div id="crop-modal" class="hidden">
        <div id="crop-container">
            <img id="crop-image" src="#" data-i18n-alt="crop_alt_text">
            <div id="crop-box">
                <div class="resize-handle top-left"></div>
                <div class="resize-handle top-right"></div>
                <div class="resize-handle bottom-left"></div>
                <div class="resize-handle bottom-right"></div>
            </div>
        </div>
        <div id="crop-buttons">
            <button id="cancel-crop" class="button" data-i18n="cancel">Cancel</button>
            <button id="crop-button" class="button primary" data-i18n="crop_and_use">Crop & Use</button>
        </div>
    </div>

    <div id="custom-alert-modal" class="custom-alert hidden">
        <div class="custom-alert-content">
            <h3 id="alert-title"></h3>
            <p id="alert-message"></p>
            <button id="alert-ok-button" class="button primary">OK</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const section1 = document.getElementById('section1');
            const section2 = document.getElementById('section2');
            const namesInput = document.getElementById('names-input');
            const bgUpload = document.getElementById('bg-upload');
            const startTransitionButton = document.getElementById('start-transition-button');
            const startButton = document.getElementById('start-button');
            const fullscreenButton = document.getElementById('fullscreen-button');
            const backButton = document.getElementById('back-button');
            const startAgainButton = document.getElementById('start-again-button');
            const toggleModeButton = document.getElementById('toggle-mode-button');
            const deleteBgButton = document.getElementById('delete-bg-button'); // New element
            const languageButton = document.getElementById('language-button');
            const languageMenu = document.getElementById('language-menu');
            const languageFlag = document.getElementById('language-flag');
            const languageLabel = document.getElementById('language-label');
            const includeWinnerCheckbox = document.getElementById('include-winner-checkbox');
            const resultDiv = document.getElementById('result');
            const previewDiv = document.getElementById('background-preview');

            const adWrapper = document.getElementById('ad-wrapper');

            const cropModal = document.getElementById('crop-modal');
            const cropImage = document.getElementById('crop-image');
            const cropBox = document.getElementById('crop-box');
            const cropButton = document.getElementById('crop-button');
            const cancelCropButton = document.getElementById('cancel-crop');
            const cropContainer = document.getElementById('crop-container');

            const customAlertModal = document.getElementById('custom-alert-modal');
            const alertTitle = document.getElementById('alert-title');
            const alertMessage = document.getElementById('alert-message');
            const alertOkButton = document.getElementById('alert-ok-button');

            let namesArray = [];
            let originalNamesArray = [];
            let intervalId = null;
            let isRunning = false;
            
            const translations = {
                'id': { 
                    'title': 'Pengacak Nama Ajaib ✨', 
                    'description': 'Selamat datang di pengacak nama online gratis!', 
                    'names_input_label': 'Masukkan Nama (satu per baris):', 
                    'names_placeholder': 'Contoh:\nBudi\nSanti\nAgus\nClarissa', 
                    'preview_title': 'Pratinjau Latar Belakang:', 
                    'change_background': 'Ganti Latar Belakang', 
                    'delete_background': 'Hapus Latar Belakang', // New translation
                    'start': 'Mulai', 
                    'toggle_mode_light': 'Mode Terang', 
                    'toggle_mode_dark': 'Mode Gelap', 
                    'fullscreen': 'Layar Penuh', 
                    'initial_text': "Tekan 'Mulai Acak' untuk memilih nama pemenang!", 
                    'back': 'Kembali', 
                    'start_shuffle': 'Mulai Acak', 
                    'start_again': 'Ulangi Acak', 
                    'winner_congratulations': '🎉 Selamat!', 
                    'alert_names_empty': 'Silakan masukkan setidaknya satu nama.', 
                    'crop_alt_text': 'Gambar untuk dipotong', 
                    'cancel': 'Batal', 
                    'crop_and_use': 'Potong & Gunakan', 
                    'include_winner_label': 'Sertakan pemenang dalam pengacakan berikutnya', 
                    'alert_title': 'Perhatian!', 
                    'alert_no_names': 'Tolong masukkan setidaknya satu nama.' 
                },
                'en': { 
                    'title': 'Random Name Picker & Prize Draw Generator ✨', 
                    'description': 'Welcome to the free online name picker!', 
                    'names_input_label': 'Enter Names (one per line):', 
                    'names_placeholder': 'Example:\nJohn\nSarah\nDavid\nClarissa', 
                    'preview_title': 'Background Preview:', 
                    'change_background': 'Change Background', 
                    'delete_background': 'Delete Background', // New translation
                    'start': 'Start', 
                    'toggle_mode_light': 'Light Mode', 
                    'toggle_mode_dark': 'Dark Mode', 
                    'fullscreen': 'Fullscreen', 
                    'initial_text': "Press 'Start Shuffle' to pick a winner!", 
                    'back': 'Back', 
                    'start_shuffle': 'Start Shuffle', 
                    'start_again': 'Shuffle Again', 
                    'winner_congratulations': '🎉 Congratulations!', 
                    'alert_names_empty': 'Please enter at least one name.', 
                    'crop_alt_text': 'Image to be cropped', 
                    'cancel': 'Cancel', 
                    'crop_and_use': 'Crop & Use', 
                    'include_winner_label': 'Include winner in next shuffle', 
                    'alert_title': 'Attention!', 
                    'alert_no_names': 'Please enter at least one name.' 
                }
            };
            
            const languageNames = { 'id': 'Bahasa Indonesia', 'en': 'English' };
            const languageFlags = { 'id': '🇮🇩', 'en': '🇺🇸' };

            let currentLang = 'en';

            function showCustomAlert(message) {
                alertTitle.textContent = translations[currentLang]['alert_title'];
                alertMessage.textContent = message;
                customAlertModal.classList.add('show');
                alertOkButton.focus();
            }

            alertOkButton.addEventListener('click', () => {
                customAlertModal.classList.remove('show');
            });

            function setTheme(isLight) {
                if (isLight) {
                    document.body.classList.add('light-mode');
                    toggleModeButton.textContent = translations[currentLang]['toggle_mode_dark'];
                } else {
                    document.body.classList.remove('light-mode');
                    toggleModeButton.textContent = translations[currentLang]['toggle_mode_light'];
                }
                localStorage.setItem('theme', isLight ? 'light' : 'dark');
            }

            function setLanguage(lang) {
                currentLang = lang;
                document.querySelectorAll('[data-i18n]').forEach(element => {
                    const key = element.getAttribute('data-i18n');
                    if (translations[lang] && translations[lang][key]) {
                        element.textContent = translations[lang][key];
                    }
                });
                document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                    const key = element.getAttribute('data-i18n-placeholder');
                    if (translations[lang] && translations[lang][key]) {
                        element.placeholder = translations[lang][key];
                    }
                });
                document.querySelectorAll('[data-i18n-alt]').forEach(element => {
                    const key = element.getAttribute('data-i18n-alt');
                    if (translations[lang] && translations[lang][key]) {
                        element.alt = translations[lang][key];
                    }
                });
                document.title = translations[lang]['title'];

                // Update text for toggle mode button based on current mode and language
                const isLightMode = document.body.classList.contains('light-mode');
                toggleModeButton.textContent = isLightMode ? translations[lang]['toggle_mode_dark'] : translations[lang]['toggle_mode_light'];

                languageFlag.textContent = languageFlags[lang];
                languageLabel.textContent = languageNames[lang];

                // Ensure delete button visibility is updated
                updateDeleteButtonVisibility();
            }
            
            languageButton.addEventListener('click', (e) => {
                e.stopPropagation();
                languageMenu.classList.toggle('active');
                languageButton.parentNode.classList.toggle('active');
            });

            languageMenu.addEventListener('click', (e) => {
                e.stopPropagation();
                const lang = e.target.closest('.language-menu-item')?.dataset.lang;
                if (lang) {
                    setLanguage(lang);
                    localStorage.setItem('language', lang);
                    languageMenu.classList.remove('active');
                    languageButton.parentNode.classList.remove('active');
                }
            });

            document.addEventListener('click', (e) => {
                if (!languageButton.parentNode.contains(e.target)) {
                    languageMenu.classList.remove('active');
                    languageButton.parentNode.classList.remove('active');
                }
            });
            
            const savedLang = localStorage.getItem('language');
            if (savedLang && translations[savedLang]) {
                setLanguage(savedLang);
            } else {
                setLanguage('en');
            }
            
            namesInput.value = localStorage.getItem('names') || '';
            const savedBg = localStorage.getItem('background');
            if (savedBg) {
                previewDiv.style.backgroundImage = `url(${savedBg})`;
                previewDiv.textContent = '';
                deleteBgButton.classList.remove('hidden'); // Show delete button if background exists
            } else {
                previewDiv.textContent = translations[currentLang]['preview_title']; // Restore text if no background
            }
            
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                setTheme(true);
            } else {
                setTheme(false);
            }
            
            toggleModeButton.addEventListener('click', () => {
                const isLightMode = document.body.classList.contains('light-mode');
                setTheme(!isLightMode);
            });

            // Function to update delete button visibility
            function updateDeleteButtonVisibility() {
                if (localStorage.getItem('background')) {
                    deleteBgButton.classList.remove('hidden');
                } else {
                    deleteBgButton.classList.add('hidden');
                }
            }
            
            bgUpload.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        cropImage.src = event.target.result;
                        cropModal.classList.remove('hidden');
                        
                        cropImage.onload = () => {
                            const imageRatio = cropImage.naturalWidth / cropImage.naturalHeight;
                            const cropRatio = 16 / 9;
                            
                            let boxWidth, boxHeight;
                            if (imageRatio > cropRatio) {
                                boxHeight = cropImage.clientHeight;
                                boxWidth = boxHeight * cropRatio;
                            } else {
                                boxWidth = cropImage.clientWidth;
                                boxHeight = boxWidth / cropRatio;
                            }

                            Object.assign(cropBox.style, {
                                width: `${boxWidth}px`,
                                height: `${boxHeight}px`,
                                left: `${(cropContainer.clientWidth - boxWidth) / 2}px`,
                                top: `${(cropContainer.clientHeight - boxHeight) / 2}px`
                            });
                        };
                    };
                    reader.readAsDataURL(file);
                }
            });

            let isDragging = false;
            let startX, startY;
            let currentHandle = null;
            let startWidth, startHeight, startLeft, startTop;

            cropBox.addEventListener('mousedown', (e) => {
                e.preventDefault();
                isDragging = true;
                startX = e.clientX;
                startY = e.clientY;
                const cropBoxRect = cropBox.getBoundingClientRect();
                startWidth = cropBoxRect.width;
                startHeight = cropBoxRect.height;
                startLeft = cropBox.offsetLeft;
                startTop = cropBox.offsetTop;
                
                if (e.target.classList.contains('resize-handle')) {
                    currentHandle = e.target.classList[1];
                } else {
                    currentHandle = 'move';
                    cropBox.style.cursor = 'grabbing';
                }
            });
            
            document.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                
                const cropBoxRect = cropBox.getBoundingClientRect();
                const containerRect = cropContainer.getBoundingClientRect();
                
                let newLeft = cropBox.offsetLeft;
                let newTop = cropBox.offsetTop;
                let newWidth = cropBox.offsetWidth;
                
                const dx = e.clientX - startX;
                const dy = e.clientY - startY;

                if (currentHandle === 'move') {
                    newLeft = startLeft + dx;
                    newTop = startTop + dy;
                } else {
                    const ratio = 16 / 9;
                    if (currentHandle.includes('left')) {
                        newWidth = startWidth - dx;
                        newLeft = startLeft + dx;
                    } else if (currentHandle.includes('right')) {
                        newWidth = startWidth + dx;
                    }

                    let newHeight = newWidth / ratio;
                    
                    if (currentHandle.includes('top')) {
                        newTop = startTop + (startHeight - newHeight);
                    }

                    if (newWidth < 50 || newHeight < 50) return;
                    
                    newLeft = Math.max(0, Math.min(newLeft, containerRect.width - newWidth));
                    newTop = Math.max(0, Math.min(newTop, containerRect.height - newHeight));

                    Object.assign(cropBox.style, {
                        width: `${newWidth}px`,
                        height: `${newHeight}px`,
                        left: `${newLeft}px`,
                        top: `${newTop}px`
                    });
                }
                
                if (newLeft < 0) newLeft = 0;
                if (newTop < 0) newTop = 0;
                if (newLeft + newWidth > containerRect.width) newLeft = containerRect.width - newWidth;
                if (newTop + newHeight > containerRect.height) newTop = containerRect.height - newHeight;

                Object.assign(cropBox.style, {
                    left: `${newLeft}px`,
                    top: `${newTop}px`
                });

                startX = e.clientX;
                startY = e.clientY;
                startLeft = newLeft;
                startTop = newTop;
            });

            document.addEventListener('mouseup', () => {
                isDragging = false;
                currentHandle = null;
                cropBox.style.cursor = 'grab';
            });

            cropButton.addEventListener('click', () => {
                const image = new Image();
                image.src = cropImage.src;
                image.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    
                    const cropBoxRect = cropBox.getBoundingClientRect();
                    const imageRect = cropImage.getBoundingClientRect();
                    
                    const scaleX = image.naturalWidth / imageRect.width;
                    const scaleY = image.naturalHeight / imageRect.height;
                    
                    const cropX = (cropBoxRect.left - imageRect.left) * scaleX;
                    const cropY = (cropBoxRect.top - imageRect.top) * scaleY;
                    const cropWidth = cropBoxRect.width * scaleX;
                    const cropHeight = cropBoxRect.height * scaleY;
                    
                    canvas.width = 1920; 
                    canvas.height = 1080;
                    
                    ctx.drawImage(image, cropX, cropY, cropWidth, cropHeight, 0, 0, canvas.width, canvas.height);
                    
                    const croppedImageURL = canvas.toDataURL('image/jpeg');
                    
                    previewDiv.style.backgroundImage = `url(${croppedImageURL})`;
                    previewDiv.textContent = '';
                    localStorage.setItem('background', croppedImageURL);
                    updateDeleteButtonVisibility(); // Update visibility after saving
                    
                    cropModal.classList.add('hidden');
                    bgUpload.value = '';
                };
            });

            cancelCropButton.addEventListener('click', () => {
                cropModal.classList.add('hidden');
                bgUpload.value = '';
            });
            
            // New event listener for delete background button
            deleteBgButton.addEventListener('click', () => {
                localStorage.removeItem('background');
                previewDiv.style.backgroundImage = 'none';
                previewDiv.textContent = translations[currentLang]['preview_title']; // Restore text
                updateDeleteButtonVisibility(); // Hide button after deleting
            });

            startTransitionButton.addEventListener('click', () => {
                const names = namesInput.value.split('\n')
                    .map(name => name.trim())
                    .filter(name => name !== '')
                    .filter(name => /^[a-zA-Z0-9\s-'.]+$/.test(name));

                if (names.length === 0) {
                    showCustomAlert(translations[currentLang]['alert_names_empty']);
                    return;
                }
                namesArray = names;
                originalNamesArray = [...namesArray];
                localStorage.setItem('names', namesInput.value);
                
                const bgUrl = localStorage.getItem('background');
                if (bgUrl) {
                    section2.style.backgroundImage = `url(${bgUrl})`;
                    section2.classList.add('has-background');
                } else {
                    section2.style.backgroundImage = 'none';
                    section2.classList.remove('has-background');
                }
                document.body.style.backgroundImage = 'none'; // Ensure body only has color background

                if (adWrapper) {
                    adWrapper.classList.remove('show');
                }

                section1.style.opacity = '0';
                section1.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    section1.classList.add('hidden');
                    section2.classList.remove('hidden');
                    section2.style.opacity = '0';
                    setTimeout(() => {
                        section2.style.opacity = '1';
                        startButton.classList.remove('hidden');
                        startAgainButton.classList.add('hidden');
                        resultDiv.innerHTML = `<p class="initial-text">${translations[currentLang]['initial_text']}</p>`;
                    }, 50);
                }, 500);
            });
            
            startButton.addEventListener('click', () => {
                if (namesArray.length === 0) {
                    showCustomAlert(translations[currentLang]['alert_names_empty']);
                    return;
                }
                resultDiv.textContent = '';
                startButton.classList.add('hidden');
                backButton.classList.add('hidden');
                startRandomizer();
            });

            function startRandomizer() {
                if (isRunning) return;
                isRunning = true;
                
                resultDiv.classList.remove('stopped');
                resultDiv.classList.add('shaking');
                
                intervalId = setInterval(() => {
                    const randomIndex = Math.floor(Math.random() * namesArray.length);
                    resultDiv.textContent = namesArray[randomIndex];
                }, 100);

                setTimeout(() => {
                    clearInterval(intervalId);
                    intervalId = null;
                    isRunning = false;
                    
                    resultDiv.classList.remove('shaking');
                    
                    const finalIndex = Math.floor(Math.random() * namesArray.length);
                    const winnerName = namesArray[finalIndex];
                    
                    const congratulations = document.createElement('div');
                    congratulations.className = 'congratulations-text';
                    congratulations.textContent = translations[currentLang]['winner_congratulations'];
                    
                    const finalNameDiv = document.createElement('div');
                    finalNameDiv.textContent = `👑 ${winnerName} 👑`;
                    finalNameDiv.id = 'winner-name';

                    resultDiv.innerHTML = '';
                    resultDiv.appendChild(congratulations);
                    resultDiv.appendChild(finalNameDiv);

                    startButton.classList.add('hidden');
                    startAgainButton.classList.remove('hidden');
                    backButton.classList.remove('hidden');
                    
                    if (!includeWinnerCheckbox.checked) {
                        const winnerIndex = namesArray.indexOf(winnerName);
                        if (winnerIndex > -1) {
                            namesArray.splice(winnerIndex, 1);
                        }
                    }
                }, 4000);
            }

            startAgainButton.addEventListener('click', () => {
                if (namesArray.length === 0) {
                    showCustomAlert(translations[currentLang]['alert_names_empty']);
                    resetToSection1();
                    return;
                }
                
                resultDiv.innerHTML = `<p class="initial-text">${translations[currentLang]['initial_text']}</p>`;
                startAgainButton.classList.add('hidden');
                startButton.classList.remove('hidden');
                backButton.classList.remove('hidden');
            });
            
            backButton.addEventListener('click', () => {
                resetToSection1();
            });

            function resetToSection1() {
                clearInterval(intervalId);
                intervalId = null;
                isRunning = false;
                
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme === 'light') {
                    setTheme(true);
                } else {
                    setTheme(false);
                }
                
                // Menghapus latar belakang yang tersimpan di section2
                section2.style.backgroundImage = 'none';
                section2.classList.remove('has-background');
            
                namesArray = [...originalNamesArray];

                if (adWrapper) {
                    adWrapper.classList.add('show');
                }

                section2.style.opacity = '0';
                setTimeout(() => {
                    section2.classList.add('hidden');
                    section1.classList.remove('hidden');
                    Object.assign(section1.style, { opacity: '1', transform: 'scale(1)' });
                }, 500);
            }

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' || e.key === 'q') {
                    if (document.fullscreenElement) {
                        document.exitFullscreen();
                    } else if (customAlertModal.classList.contains('show')) {
                        customAlertModal.classList.remove('show');
                    } else if (!section1.classList.contains('hidden')) {
                        if (!cropModal.classList.contains('hidden')) {
                            cropModal.classList.add('hidden');
                        }
                    } else if (!section2.classList.contains('hidden')) {
                        resetToSection1();
                    }
                }
            });

            fullscreenButton.addEventListener('click', () => {
                const elem = document.documentElement;
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                }
            });
            
            document.addEventListener('fullscreenchange', () => {
                if (document.fullscreenElement) {
                    fullscreenButton.classList.add('hidden');
                } else {
                    fullscreenButton.classList.remove('hidden');
                }
            });

            // Initial call to set delete button visibility on page load
            updateDeleteButtonVisibility();
        });
    </script>
</body>
</html>