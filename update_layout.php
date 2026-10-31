<?php
$path = 'resources/views/admin/layouts/app.blade.php';
$content = file_get_contents($path);
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
";
$content = str_replace('    </style>', $css . '    </style>', $content);
$content = preg_replace('/<body>.*?<\/body>/s', "<body>\n\n    @include('admin.layouts.sidebar')\n\n    <main class=\"admin-main\">\n        @yield('content')\n    </main>\n\n</body>", $content);
file_put_contents($path, $content);
echo 'Success';
