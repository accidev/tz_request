<form action="{{route('products.uploadExcel')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="default_size">Excel file</label>
    <input class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size" name="file" type="file">

    <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">import</button>
</form>

