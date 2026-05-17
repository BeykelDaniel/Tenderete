<h2>Solicitud de Soporte Recibida</h2>
<p>Se ha enviado un mensaje desde el formulario web de Saber Más:</p>

<ul>
    <li><strong>Nombre del usuario:</strong> {{ $data['name'] }}</li>
    <li><strong>Correo electrónico de contacto:</strong> {{ $data['email'] }}</li>
</ul>

<p><strong>Mensaje o Problema:</strong></p>
<div style="background: #f3f4f6; padding: 15px; border-radius: 8px;">
    {{ $data['message'] }}
</div>
