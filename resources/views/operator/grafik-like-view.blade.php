<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Grafik Statistik</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-daftar-operator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>

  <!-- Tombol toggle sidebar -->
  <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

  <div class="container">
    <!-- Header -->
    <div class="header">
      <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
        <span>ARSIP KONTEN MEDIA SOSIAL & WEBSITE</span>
      </div>
    </div>

    <div class="datauser-bar">
      <span class="datauser-title">Grafik</span>
    </div>

    <div class="content">
      <!-- Sidebar -->
      <nav class="sidebar">
        <ul>
          <li>
            <a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
              <i class="fas fa-home"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="{{ route('operator.daftar-arsip') }}" class="{{ Request::routeIs('operator.daftar-arsip') ? 'active' : '' }}">
              <i class="fas fa-folder-open"></i> Lihat Arsip
            </a>
          </li>
          <li>
            <a href="{{ route('operator.arsip.create') }}" class="{{ Request::routeIs('operator.arsip.create') ? 'active' : '' }}">
              <i class="fas fa-upload"></i> Upload
            </a>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="main-content">

        <div style="max-width: 600px; margin: 40px auto;">
          <div id="grafikHighchart" style="width: 100%; height: 400px;"></div>
        </div>

        @php
          $like = $statistik['Like'];
          $view = $statistik['View'];
          $total = max($like + $view, 1);
        @endphp

        <div style="text-align: center; margin-top: 15px;">
          <span style="color: orange;"><strong>● Like</strong> ({{ round(($like / $total) * 100) }}%)</span>
          &nbsp;&nbsp;
          <span style="color: red;"><strong>● View</strong> ({{ round(($view / $total) * 100) }}%)</span>
        </div>

        
      </main>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
    }

    Highcharts.chart('grafikHighchart', {
      chart: {
        type: 'pie',
        
      },
      title: {
        text: 'Statistik Like & View',
        style: {
          fontSize: '16px'
        }
      },
      credits: {
        enabled: false // ← Menghilangkan watermark "highcharts.com"
      },
      exporting: {
        enabled: true
      },
      accessibility: {
        announceNewData: {
          enabled: true
        }
      },
      plotOptions: {
        pie: {
          innerSize: '60%',
          dataLabels: {
            enabled: true,
            format: '{point.name}: {point.y} ({point.percentage:.1f}%)',
            style: {
              fontSize: '13px'
            }
          }
        }
      },
      series: [{
        name: 'Jumlah',
        colorByPoint: true,
        data: [
          { name: 'Like', y: {{ $like }}, color: 'orange' },
          { name: 'View', y: {{ $view }}, color: 'red' }
        ]
      }]
    });
  </script>

</body>
</html>
