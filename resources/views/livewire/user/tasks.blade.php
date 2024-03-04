<div>
   <div class="row">
      <div class="col-lg-12">
         <div class="todo-breadcrumb">
            <div class="breadcrumb-main">
               <h4 class="text-capitalize breadcrumb-title">Mijn taken</h4>
               <div class="breadcrumb-action justify-content-center flex-wrap">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xl-12">
         <div class="card mb-25">
            <div class="card-body">
               <input wire:model = "todo_text" wire:keydown.enter = "save()"  placeholder = "Vul een taak in en druk op enter"class = "form-control form-control-lg">
               
               
            </div>
            </div>
            </div>
            </div>

            <div class="row">
      <div class="col-xl-12">
         <div class="card mb-25">
            <div class="card-body">

@if(!count($tasks))
               <div class="  text-center">
                  <div class="mb-4">
                     <img style="height: 300px" src="/assets/img/illu/dot-voting-2-e1608815414590.png" alt="Image Description" data-hs-theme-appearance="default" />
                  </div>
                  <div class="mb-3">
                     <p>Het lijkt er op dat er geen taken zijn voor jouw
                     </p>
                  </div>
               </div>
            </div>
            @else
            <div class="table-responsive">
               <table class="table  ">
                  <tbody class="ui-sortable">
                     @foreach($tasks as $task)
                     <tr>
                        <td>
                           <div class = "pt-2">   {{ucfirst($task->todo_text)}}</div>
                        </td>
                        <td style = "width: 20px;">
                           <button wire:click="closeTask({{$task->id}})" class  = "btn btn-sm btn-rounded btn-outline-success   " >
                           Voltooien 
                           </button>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            @endif 
         </div>
      </div>
   </div>
</div>
 