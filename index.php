<?php
$resultado = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cpf'])) {
    $cpf = preg_replace('/\D/', '', $_POST['cpf']);

    if (strlen($cpf) !== 11) {
        $resultado = "<div class='alert alert-danger mt-3 animate__animated animate__shakeX'>CPF inválido</div>";
    } else {
        $apiKey = "SUA_CHAVE_API_AQUI";
        $url = "https://apicpf.com/api/consulta?cpf=$cpf&api_key=$apiKey";

        $response = @file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['data'])) {
            $resultado = "<div class='card glass-card mt-4 p-4 animate__animated animate__fadeInUp'>";
            $resultado .= "<h4 class='card-title text-center mb-3'>Resultado da Consulta</h4>";
            $resultado .= "<div>";
            $resultado .= "<div style=\"color: white;\"><strong>Nome:</strong> " . htmlspecialchars($data['data']['nome']) . "</div>";
            $cpf = preg_replace('/\D/', '', $data['data']['cpf']);
            $cpf_formatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
            $resultado .= "<div style=\"color: white;\"><strong>CPF:</strong> " . htmlspecialchars($cpf_formatado) . "</div>";
            $resultado .= "<div style=\"color: white;\"><strong>Gênero:</strong> " . htmlspecialchars($data['data']['genero']) . "</div>";
            $data_nascimento = DateTime::createFromFormat('Y-m-d', $data['data']['data_nascimento']);
            $data_formatada = $data_nascimento ? $data_nascimento->format('d/m/Y') : '';
            $resultado .= "<div style=\"color: white;\"><strong>Data de Nascimento:</strong> " . htmlspecialchars($data_formatada) . "</div>";
            $resultado .= "</div>";
            $resultado .= "</div>";
        } else {
            $resultado = "<div class='alert alert-warning mt-3 animate__animated animate__fadeIn'>Erro ao obter os dados do CPF.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API | CPF Search</title>
    <link rel="shortcut icon" href="search.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            cursor: url('/search.svg'), auto;
            background: #121212;
            color: #eee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            padding-bottom: 5%;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -2;
            top: 0;
            left: 0;
        }

        .navbar {
            background-color: transparent;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .github-link {
            color: #eee;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .github-link:hover {
            color: #e74c3c;
        }

        #orientacao {
            max-width: 900px;
            margin: 40px auto;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(231, 76, 60, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding-left: 20px;
            padding-right: 20px;
        }

        #orientacao .orientacao-text {
            flex: 1;
        }

        #orientacao h3 {
            color: #e74c3c;
            text-align: left;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        #orientacao p {
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        #orientacao .orientacao-icon {
            color: #e74c3c;
            font-size: 6rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 500px;
            margin: 20px auto 20px;
            box-shadow: 0 8px 32px 0 rgba(231, 76, 60, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding-left: 20px;
            padding-right: 20px;
        }

        .form-container h3 {
            font-size: 2.5rem;
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }

        .form-label {
            color: #ccc;
            font-weight: 500;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: #e74c3c;
        }

        .form-control {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #eee;
        }

        .form-control:focus {
            background-color: rgba(0, 0, 0, 0.5);
            border-color: #e74c3c;
        }

        .btn-primary {
            background-color: #e74c3c;
            border: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #c0392b;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px 0 rgba(231, 76, 60, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
        }

        .footer-links a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        .footer-links a:hover {
            color: #c0392b;
        }

        /* Responsividade para telas pequenas */
        @media (max-width: 576px) {
            #orientacao {
                flex-direction: column;
                text-align: center;
                padding-left: 10px;
                padding-right: 10px;
            }

            #orientacao .orientacao-icon {
                margin-bottom: 20px;
                font-size: 4rem;
            }

            .form-container,
            #orientacao {
                padding: 1.5rem;
                margin: 20px auto 20px;
            }

            .form-container h3,
            #orientacao h3 {
                font-size: 2rem;
            }

            .form-container {
                max-width: 100%;
            }
        }

        /* Responsividade para telas médias */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .form-container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>

</head>

<body>
    <div id="particles-js"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://cdn-icons-png.flaticon.com/512/1161/1161417.png" alt="Logo Detetive">
            </a>
            <div class="d-flex">
                <a class="github-link" href="https://github.com/psilvagg/api-cpf" target="_blank">
                    <i class="fab fa-github"></i> GitHub
                </a>
            </div>
        </div>
    </nav>

    <!-- Orientações -->
    <div id="orientacao" class="animate__animated animate__fadeInUp">
        <div class="orientacao-icon">
            <i class="fas fa-search-plus"></i>
        </div>
        <div class="orientacao-text">
            <h3>Orientações</h3>
            <p><strong>Como consultar?</strong></p>
            <p>1. Insira o CPF (com ou sem formatação) no campo da consulta.</p>
            <p>2. Clique em "Consultar" e aguarde os resultados.</p>
            <p>3. Se o CPF for válido, os dados serão exibidos logo abaixo.</p>
            <p>4. Em caso de erro, verifique o número informado e tente novamente.</p>
        </div>
    </div>

    <!-- Formulário -->
    <div class="form-container animate__animated animate__fadeInDown" id="consultar">
        <form method="POST">
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" name="cpf" id="cpf" maxlength="14" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Consultar</button>
        </form>
        <?= $resultado; ?>
    </div>

    <!-- Rodapé -->
    <div class="footer-links animate__animated animate__fadeIn">
        <a href="www.apicpf.com" target="_blank">www.apicpf.com</a> |
        <a href="https://github.com/seu_usuario/seu_repositorio" target="_blank">GitHub</a>
    </div>

    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>