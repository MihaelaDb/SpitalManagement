# Documentatie

In acest proiect poti sa te inregistrezi ca doctor sau ca user. Dupa logare, userii pot face programari, iar doctorii pot vedea toate programarile, le pot edita sau sterge.

## Baza de date

Proiectul foloseste o baza de date numita **spital_management** care are doua tabele principale:

- **users**: contine campurile *id, name, email, password, role* (doctor sau user) si timestamp-uri.
- **appointments**: contine campurile *id, patient_id, doctor_id, appointment_datetime, description* si timestamp-uri.

## Codul

Codul este scris in PHP folosind un design pattern MVC:

- **public/index.php**: punctul de intrare care face routing-ul intre pagini.
- **Controlere** (AuthController, AppointmentController): gestioneaza logica pentru autentificare si operatiile CRUD pentru programari.
- **Modele** (User, Appointment): contin functii pentru interactiunea cu baza de date.
- **Views**: sunt paginile HTML/PHP care folosesc Bootstrap 5 pentru un design simplu si responsive.

## Cum functioneaza codul

Proiectul permite utilizatorilor sa se inregistreze, sa se logheze si sa gestioneze programarile. Userii pot crea programari, iar doctorii pot vedea toate programarile, edita sau sterge pe cele existente.
