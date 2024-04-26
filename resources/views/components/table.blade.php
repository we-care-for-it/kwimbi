{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}



<div class="table table-responsive   table-hover">
          <div id="datatable_wrapper" class="dataTables_wrapper no-footer"> 
<table class="table   table-thead-bordered card-table dataTable no-footer">
<thead class="thead-light">
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody class="">
            {{ $body }}
        </tbody>
    </table>
</div></div>