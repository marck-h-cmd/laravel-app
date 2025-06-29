<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>.::SISTEMA DE VENTAS - ABC::.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
</head>

    <body class="login"> 

        
        <div class="logo">
            <img src="/img/visa.png" alt="Sistema de Ventas & ABC">
            <p>Sistema de Ventas & ABC</p>
        </div>
        <div class="content">                         
      
        <form method="POST" action="{{Route('identificacion') }}">                         
              @csrf  
                <h4 class="form-title">Inicio de Sesión</h4>
                <div class="form-group">
                     <label class="control-label">USUARIO:</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input class="form-control @error('name') is-invalid @enderror"  type="text"  placeholder="Ingrese usuario" id="name" name="name" value="{{old('name')}}"/>                        
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                     </div>
                </div>
                <div class="form-group">
                    <label class="control-label">CONTRASEÑA:</label>
                    <div class="input-icon">
                           <i class="fas fa-lock"></i>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Ingrese contraseña"  id="password" name="password"  value="{{old('password')}}"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>                

                <hr />
                <div class="form-actions">
                    <button class="btn btn-success btn-block">
                         Ingresar </button>
                </div>
                <hr />
            </form>            
        </div>
        <div class="copyright">
            2020 &copy; Sistema de Ventas & ABC.
        </div>
        <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
        <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/adminlte/dist/js/adminlte.min.js"></script>        

</body>
    

</html>