@php
use \App\Enums\ActionTypes;
@endphp
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{{ $subject ?? 'Notification' }}</title>
      <style>
         /* Tailwind-inspired inline styles */
         body {
         font-family: 'Verdana', sans-serif;
         background-color: #f8fafc;
         margin: 0;
         padding: 0;
         color: #374151;
         }
         .email-wrapper {
         width: 100%;
         padding: 20px;
         display: flex;
         justify-content: center;
         }
         .email-container {
         width: 100%;
         max-width: 600px;
         background-color: #ffffff;
         border: 1px solid #e5e7eb;
         border-radius: 8px;
         overflow: hidden;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         }
         .email-header {
         background-color: #8BD990;
         color: #ffffff;
         padding: 20px;
         text-align: center;
         font-size: 24px;
         }
         .email-body {
         padding: 20px;
         font-size: 16px;
         line-height: 1.5;
         }
         .email-footer {
         background-color: #f3f4f6;
         text-align: center;
         padding: 20px;
         line-height: 20px;
         font-size: 14px;
         color: #9ca3af;
         }
         .button {
         display: inline-block;
         background-color: #8BD990;
         color: #ffffff;
         padding: 10px 20px;
         text-decoration: none;
         border-radius: 4px;
         margin-top: 10px;
         font-weight: bold;
         }
         .button:hover {
         background-color: #8BD990;
         }
         a {
         color: #8BD990;
         text-decoration: none;
         }
         table, th, td {
         border: 1px solid #EFEFEF;
         padding:4px;
         border-collapse: collapse;
         }
      </style>
   </head>
   <body>
      <div class="email-wrapper">
         <div class="email-container">
            <!-- Header -->
            <div class="email-header">
               {{ucfirst($action?->type)}}
            </div>
            <!-- Body -->
            <div class="email-body">
               <p>
                  Beste, {{$action->for_user?->name}}
                  <br><br>{{$action->create_by_user?->name}} heeft een actie op jouw naam gezet, Zie hieronder de details.
                  <br>      <br>
                  @if($action?->tile)
                  <b>Titel</b><br>
                  {{$action?->title ?? "<small>Niet opgegeven</small>"}}
                  @endif
               <table style = "width: 100%">
                  <tr>
                     <td><b>Soort:</b></td>
                     <td>
                        {{ucfirst($action?->type)}}
                     </td>
                  </tr>
                  <tr>
                     @if($action?->company)
                     <td><b>Bedrijf:</b></td>
                     <td> {{$action?->company?->name ?? "<small>Niet opgegeven</small>"}}</td>
                  </tr>
                  @endif
                  @if($action?->customer)
                  <tr>
                     <td><b>Relatie:</b></td>
                     <td> {{$action?->customer?->name ?? "<small>Niet opgegeven</small>"}}</td>
                  </tr>
                  @endif
               </table>
               <br>
               @if($action?->body)
               <b>Uitgebreide omschrijving:</b><br>
               {{$action?->body ?? "<small>Niet opgegeven</small>"}}
               @endif
               <br>    <br>
               Met vriendelijke groet, <br>
               Digilevel mailer
               </p>
               <center>
               </center>
            </div>
            <!-- Footer -->
            <div class="email-footer">
               <center>
                  &copy; {{ date('Y') }} <a href = "https://www.digilevel.nl">Digilevel.nl</a>
                  <br>
                  <small>Je ontvang deze mail omdat je een gebruiker bent van een Digilevel omgeving</small>
               </center>
            </div>
         </div>
      </div>
   </body>
</html>
