$path = 'd:\job hunting laravel\resources\views\admin\layouts\app.blade.php'
$content = Get-Content $path -Raw
$css = "
        .admin-main {
            margin-left: 250px;
            min-height: 100vh;
            background: #f7f8fc;
        }

        @media (max-width: 900px) {
            .admin-main {
                margin-left: 80px;
            }
        }
"
$content = $content.Replace("    </style>", $css + "    </style>")
$body = "<body>`n`n    @include('admin.layouts.sidebar')`n`n    <main class=`"admin-main`">`n        @yield('content')`n    </main>`n`n</body>"
$content = [System.Text.RegularExpressions.Regex]::Replace($content, '(?s)<body>.*?</body>', $body)
Set-Content -Path $path -Value $content -NoNewline
Write-Host "Success"
