<?php include __DIR__ . '/header.php'; ?>

<h2>Documentatie</h2>

<p>In acest proiect poti sa te inregistrezi ca doctor sau ca user. Dupa logare, userii pot face programari, iar doctorii pot vedea toate programarile, le pot edita sau sterge.</p>

<h3>Baza de date</h3>
<p>Proiectul foloseste o baza de date numita <strong>spital_management</strong> care are doua tabele principale:</p>
<ul>
  <li><strong>users</strong>: contine campurile <em>id, name, email, password, role</em> (doctor sau user) si timestamp-uri.</li>
  <li><strong>appointments</strong>: contine campurile <em>id, patient_id, doctor_id, appointment_datetime, description</em> si timestamp-uri.</li>
</ul>

<h3>Codul</h3>
<p>Codul este scris in PHP folosind un design pattern MVC:</p>
<ul>
  <li><strong>public/index.php</strong>: punctul de intrare care face routing-ul intre pagini.</li>
  <li><strong>Controlere</strong> (AuthController, AppointmentController): gestioneaza logica pentru autentificare si operatiile CRUD pentru programari.</li>
  <li><strong>Modele</strong> (User, Appointment): contin functii pentru interactiunea cu baza de date.</li>
  <li><strong>Views</strong>: sunt paginile HTML/PHP care folosesc Bootstrap 5 pentru un design simplu si responsive.</li>
</ul>

<h3>Cum functioneaza codul</h3>
<p>Proiectul permite utilizatorilor sa se inregistreze, sa se logheze si sa gestioneze programarile. Userii pot crea programari, iar doctorii pot vedea toate programarile, edita sau sterge pe cele existente.</p>

<?php include __DIR__ . '/footer.php'; ?>
