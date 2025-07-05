<!-- ========== HEADER ========== -->
 <div>
   <div>
    <nav class="fixed top-0 left-64 right-0 z-50 bg-white shadow px-4 py-2 flex justify-between items-center">
     <div class="text-lg font-semibold text-gray-700">SGAImpol</div>

        <div>
              @auth
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm transition">
                    Logout
                </button>
              </form>
          @endauth
          </div>
    </nav>
 </div>
</div>
  <!-- ========== END HEADER ========== -->