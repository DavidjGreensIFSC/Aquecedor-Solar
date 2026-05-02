<!-- MUDAR PARA .PHP quando for colocado no servidor - fase modificação de layout atual  e ajeitar NAV's-->
<!-- <?php
      require_once 'conecta.php';

      $sql = "SELECT 
            temp_entrada_fria, 
            temp_saida_quente, 
            diferencial_termico, 
            data_leitura
        FROM leituras 
        ORDER BY data_leitura DESC 
        LIMIT 1";

      $stmt = $pdo->query($sql);
      $row = $stmt->fetch();

      if ($row) {
        $temp_entrada_fria = $row['temp_entrada_fria'];
        $temp_saida_quente = $row['temp_saida_quente'];
        $diferencial_termico = $row['diferencial_termico'];
        $data_leitura = $row['data_leitura'];
      } else {
        $temp_entrada_fria = null;
        $temp_saida_quente = null;
        $diferencial_termico = null;
        $data_leitura = null;
      }
      ?> -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <!-- META BASE -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#2B7A54">

  <!-- SEO -->
  <title>Aquecedor Solar | IFSC Chapecó</title>
  <meta name="description"
    content="Sistema de aquecimento de água por energia solar instalado no IFSC Chapecó. Utiliza tubos a vácuo para aquecimento eficiente e sustentável." />
  <meta name="keywords" content="aquecedor solar, energia solar, termossifão, IFSC, sustentabilidade" />
  <meta name="author" content="IFSC Chapecó" />

  <!-- OPEN GRAPH -->
  <meta property="og:title" content="Aquecedor Solar IFSC" />
  <meta property="og:description" content="Sistema sustentável de aquecimento de água com energia solar." />
  <meta property="og:image" content="assets/img/img-aquecedor-agua.png" />
  <meta property="og:type" content="website" />

  <!-- FAVICON -->
  <link rel="icon" href="assets/img/favicon.png" type="image/png">

  <!-- Preconnect (acelera DNS + conexão) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- FONTE -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>

  <!-- HEADER -->
  <header class="main-header">
    <div class="header-container glass-panel">

      <a href="" class="brand" onclick="location.reload(); return false;">
        <img src="assets/img/logo-ifsc.png" alt="Logo IFSC" class="brand-logo">
        <!-- <strong>IFSC</strong> Chapecó -->
      </a>

      <nav class="main-nav">
        <a href="#hero" class="nav-link active">Visão Geral</a>
        <a href="#section-especificacoes" class="nav-link">Sistema 3D</a>
        <a href="#funcionamento" class="nav-link">Funcionamento</a>
        <a href="#bento-features" class="nav-link">Benefícios</a>
        <a href="equipe" class="nav-link">Equipe</a>
      </nav>

      <a href="#funcionamento" class="btn-primary">Ver sistema</a>

    </div>
  </header>

  <!-- MAIN -->
  <main>

    <!-- HERO -->
    <section id="hero" class="hero section-padding">
      <div class="container hero-grid">

        <div class="hero-text reveal">
          <span class="eyebrow">Energia Limpa & Eficiência</span>

          <h1>
            Água quente todos os dias.<br>
            <span class="highlight">Sem custo. Sem impacto.</span>
          </h1>

          <p>
            Sistema de aquecimento solar instalado no IFSC Chapecó, projetado para reduzir o consumo de energia elétrica
            por meio de coletores com tubos a vácuo.
          </p>

          <div class="hero-actions">
            <a href="#funcionamento" class="btn-primary">Como funciona</a>
            <a href="#bento-features" class="btn-secondary">Ver vantagens</a>
          </div>
        </div>

        <div class="hero-visuals reveal delay-1">
          <div class="image-wrapper main-image parallax-img">
            <img src="assets/img/img-aquecedor-agua.png" alt="Sistema de aquecimento solar instalado" loading="lazy"
              onerror="this.src='https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=800&q=80'" />
          </div>

          <div class="stats-card glass-panel floating-card">
            <span class="stats-value">100%</span>
            <span class="stats-label">Sustentável</span>
          </div>
        </div>

      </div>
    </section>

    <!-- SEÇÃO ESPECIFICAÇÕES (BOILER 3D) -->
    <section id="section-especificacoes" class="section-especificacoes section-padding">
      <div class="container">
        <div class="section-heading text-center reveal">
          <h2>Visualize o Sistema em 3D</h2>
          <p>Interaja com o boiler: arraste para girar • Confira todos os ângulos</p>
        </div>

        <div class="grid-especificacoes reveal delay-1">
          <!-- BOILER 3D -->
          <div class="visual-boiler">
            <div class="container-boiler-3d">
              <canvas id="boilerCanvas"></canvas>
              <div class="indicador-angulo">
                <span id="anguloAtual">0°</span>
              </div>
              <div class="hint-rotacao">
                <i class="fa-solid fa-hand"></i>
                Arraste para girar
              </div>
            </div>
          </div>

          <!-- CONTEÚDO DO BOILER -->
          <div class="conteudo-boiler">
            <p>
              O boiler atua como reservatório térmico do sistema, armazenando a água aquecida pelos tubos a vácuo e
              reduzindo perdas de calor por meio de isolamento térmico. Ele faz a ligação entre o coletor solar e a rede
              de distribuição de água.
            </p>

            <div class="brand-badge">TEN DO BRASIL</div>
            <h3>Modelo TEN8 de Alta Performance</h3>

            <div class="tabela-specs">
              <div class="spec-linha">
                <span class="spec-label">Capacidade</span>
                <span class="spec-valor">150L</span>
              </div>
              <div class="spec-linha">
                <span class="spec-label">Limite de segurança configurado (controlador)</span>
                <span class="spec-valor">80°C</span>
              </div>
              <div class="spec-linha">
                <span class="spec-label">Tecnologia</span>
                <span class="spec-valor">Tubos a Vácuo</span>
              </div>
              <div class="spec-linha">
                <span class="spec-label">Quantidade de Tubos</span>
                <span class="spec-valor">15 Tubos</span>
              </div>
              <div class="spec-linha">
                <span class="spec-label">Material do Boiler</span>
                <span class="spec-valor">Aço inoxidável SUS304-2B</span>
              </div>
            </div>

            <!-- SENSORES DE TEMPERATURA -->
            <div class="sensores-temperatura">
              <h4>
                <i class="fa-solid fa-thermometer"></i>
                Temperatura em Tempo Real
              </h4>
              <div class="grid-sensores">
                <div class="sensor-box sensor-frio">
                  <div class="sensor-icone">
                    <i class="fa-solid fa-snowflake"></i>
                  </div>
                  <div class="sensor-info">
                    <span class="sensor-label">Entrada Fria</span>
                    <span class="sensor-valor">
                      <?php echo isset($temp_entrada_fria) ? $temp_entrada_fria . '°C' : 'Sem dados'; ?>
                    </span>
                  </div>
                </div>

                <div class="sensor-box sensor-quente">
                  <div class="sensor-icone">
                    <i class="fa-solid fa-fire"></i>
                  </div>
                  <div class="sensor-info">
                    <span class="sensor-label">Saída Quente</span>
                    <span class="sensor-valor">
                      <?= $temp_saida_quente !== null ? number_format($temp_saida_quente, 1) . '°C' : 'Sem dados' ?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="info-sensores">
                <p class="nota-tecnica">
                  Monitoramento realizado por sistema externo baseado em microcontrolador ESP8266 com sensores
                  DS18B20 instalados nas linhas de entrada e saída de água.
                </p>

                <p>
                  <strong>Diferença Térmica:</strong>
                  <?php echo isset($diferencial_termico) ? $diferencial_termico . '°C' : 'Sem dados'; ?>
                </p>
                <p>
                  <strong>Última atualização:</strong>
                  <?= $data_leitura ? date('H:i:s', strtotime($data_leitura)) : 'Sem dados' ?>
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- FUNCIONAMENTO -->
    <section id="funcionamento" class="section-padding">
      <div class="container">
        <div class="section-heading text-center reveal">
          <span class="eyebrow">Tecnologia Passiva</span>
          <h2>Como o sistema funciona</h2>
          <p>
            O equipamento capta a radiação solar e a transforma em energia térmica,
            aquecendo a água do campus a partir da conversão direta da radiação solar em energia térmica.
          </p>
        </div>

        <div class="video-wrapper reveal delay-1">
          <iframe width="100%" height="450" src="https://www.youtube.com/embed/EGry9YHDyhs"
            title="Funcionamento do aquecimento solar" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen loading="lazy">
          </iframe>
        </div>
      </div>

      <div class="bg-surface section-padding">
        <div class="container">
          <div class="section-heading text-center reveal">
            <span class="eyebrow">Princípio Físico</span>
            <h2> Tubos a vácuo + Termossifão <br>
              <span class="highlight">Redução do consumo elétrico</span>
            </h2>
            <p>
              O sistema capta o calor do sol, transfere para a água e faz a circulação natural
              por diferença de densidade. A circulação ocorre naturalmente por diferença de densidade entre a água
              quente e fria.
            </p>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="section-heading text-center reveal">
          <h2>Funcionamento passo a passo</h2>
          <p>O ciclo completo de aquecimento da água</p>
        </div>

        <div class="info-grid reveal delay-1">
          <div class="info-card highlight-card delay-1">
            <i class="fa-solid fa-sun"></i>
            <h4>1. Captação solar</h4>
            <p>Os tubos a vácuo absorvem a radiação e convertem em energia térmica com altíssima eficiência, mesmo
              em
              dias nublados.</p>
          </div>

          <div class="info-card highlight-card delay-2">
            <i class="fa-solid fa-fire"></i>
            <h4>2. Transferência</h4>
            <p>O calor é transferido diretamente para a água dentro dos tubos. O isolamento a vácuo minimiza perdas
              para o ambiente.</p>
          </div>

          <div class="info-card highlight-card delay-3">
            <i class="fa-solid fa-arrows-rotate"></i>
            <h4>3. Termossifão</h4>
            <p>A água quente (menos densa) sobe naturalmente para o boiler, enquanto a fria desce, criando um ciclo
              contínuo sem bombas.</p>
          </div>

          <div class="info-card highlight-card delay-4">
            <i class="fa-solid fa-temperature-half"></i>
            <h4>4. Armazenamento</h4>
            <p>A água quente é armazenada no Boiler (reservatório isolado), mantendo a temperatura por horas mesmo
              durante a noite.</p>
          </div>
        </div>

        <div class="section-padding">
          <div class="text-center reveal">
            <h2>Por que o sistema não precisa de eletricidade?</h2>
            <p class="funcionamento-text">
              Por ser um sistema passivo, o aquecimento funciona mesmo se houver queda de energia no campus. É a física
              trabalhando a favor da disponibilidade constante, com manutenção reduzida ao mínimo por não possuir partes
              móveis ou motores.
            </p>
            <a href="#bento-features" class="btn-primary">Ver todos os benefícios</a>
          </div>
        </div>
      </div>
    </section>

    <!-- BENEFÍCIOS -->
    <section id="bento-features" class="bento-section section-padding">
      <div class="container">

        <div class="section-heading text-center reveal">
          <h2>Por que utilizar este sistema?</h2>
          <p>Redução do consumo elétrico e baixo custo operacional.</p>
        </div>

        <div class="bento-grid reveal delay-1">

          <div class="bento-item glass-panel span-2">
            <h3>Alta Eficiência Térmica</h3>
            <p>
              Os tubos a vácuo reduzem perdas de calor e garantem excelente desempenho,
              mesmo com baixa incidência solar.
            </p>
          </div>

          <div class="bento-item glass-panel bg-copper">
            <div class="icon-box">
              <i class="fa-solid fa-shower"></i>
            </div>

            <h3>Economia de Energia</h3>

            <p>
              O chuveiro pode representar até <strong><span class="badge-highlight">30%</span> da conta de luz</strong>.
              Com o aquecedor solar, quem aquece a água é o <strong>Sol</strong> — não a energia elétrica.
            </p>
          </div>

          <div class="bento-item glass-panel">
            <h3>Durabilidade</h3>
            <p>Equipamento resistente com baixa necessidade de manutenção.</p>
          </div>

          <div class="bento-item glass-panel span-2 flex-row">

            <div class="bento-text">
              <span class="eyebrow">Controle</span>
              <h3>Impacto Positivo</h3>
              <p>
                Ao utilizar o Sol, o IFSC Chapecó deixa de emitir toneladas de CO₂ anualmente, servindo como um
                laboratório vivo de como a tecnologia pode ser aplicada para um futuro mais limpo.
              </p>
            </div>

            <div class="bento-img-small parallax-img">
              <img src="assets/img/seletor.png" alt="Controle de temperatura" loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?auto=format&fit=crop&w=400&q=80'" />
            </div>

          </div>

        </div>

      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer class="site-footer">

    <div class="container footer-grid">

      <div class="footer-brand">
        <strong>IFSC Chapecó</strong>
        <p>Aplicando inovação e sustentabilidade no cotidiano.</p>
      </div>

      <div class="footer-links">
        <h4>Navegação</h4>
        <ul>
          <li><a href="#hero">Início</a></li>
          <li><a href="#section-especificacoes">Visualizador 3D</a></li>
          <li><a href="#funcionamento">Funcionamento</a></li>
          <li><a href="#bento-features">Benefícios</a></li>
          <li><a href="equipe">Equipe</a></li>
        </ul>
      </div>

      <div class="footer-links">
        <h4>Projeto</h4>
        <ul>
          <li><a href="#">Documentação</a></li>
          <li><a href="#">Esquema técnico</a></li>
        </ul>
      </div>

    </div>

    <div class="container footer-bottom">
      <p>&copy; 2026 IFSC Chapecó</p>
    </div>

  </footer>

  <!-- JS -->
  <script src="assets/js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="assets/js/boiler-3d.js"></script>
</body>

</html>