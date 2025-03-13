<div id="form-container" class="mt-4 text-center" style="display:none;">
    <p id="instruction-text" class="instruction-text"></p>
    <form id="absensi-form" method="POST" action="">
        <input type="text" id="nim" name="nim" class="form-control w-50 mx-auto text-center" 
               maxlength="10" required oninput="hideInstruction()" placeholder="Silakan Scan kartu Anda">
        <input type="hidden" id="action" name="action">
        <button type="submit" class="btn btn-success mt-2">OK</button>
    </form>
</div>
