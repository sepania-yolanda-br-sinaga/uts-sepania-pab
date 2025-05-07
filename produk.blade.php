@endif

        <div>
          <label class="block text-gray-700 text-sm sm:text-base">Nama Produk</label>
          <input type="text" name="nama" value="{{ old('nama', $produk->nama ?? '') }}" class="w-full p-2 border rounded text-sm sm:text-base">
        </div>

        <div>
          <label class="block text-gray-700 text-sm sm:text-base">Harga</label>
          <input type="number" name="harga" value="{{ old('harga', $produk->harga ?? '') }}" class="w-full p-2 border rounded text-sm sm:text-base">
        </div>

        <div>
          <label class="block text-gray-700 text-sm sm:text-base">Deskripsi</label>
          <textarea name="deskripsi" class="w-full p-2 border rounded text-sm sm:text-base">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
        </div>

        <div>
          <label class="block text-gray-700 text-sm sm:text-base">Kategori</label>
          <input type="text" name="kategori" value="{{ old('kategori', $produk->kategori ?? '') }}" class="w-full p-2 border rounded text-sm sm:text-base">
        </div>

        <div class="flex flex-col sm:flex-row justify-between">
          <a href="{{ route('produk.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 mb-4 sm:mb-0">Kembali</a>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            {{ isset($method) && $method == 'PUT' ? 'Update' : 'Simpan' }}
          </button>
        </div>
      </form>

    @else
      {{-- TABEL DAFTAR PRODUK --}}
      <div class="flex justify-between items-center mb-6">
        <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">Tambah Produk</a>
      </div>

      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-6 py-3 text-sm sm:text-base font-medium text-gray-700">Nama Produk</th>
              <th class="px-6 py-3 text-sm sm:text-base font-medium text-gray-700">Harga</th>
              <th class="px-6 py-3 text-sm sm:text-base font-medium text-gray-700">Deskripsi</th>
              <th class="px-6 py-3 text-sm sm:text-base font-medium text-gray-700">Kategori</th>
              <th class="px-6 py-3 text-sm sm:text-base font-medium text-gray-700">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($produk as $item)
            <tr>
              <td class="px-6 py-4 text-sm sm:text-base text-gray-800">{{ $item->nama }}</td>
              <td class="px-6 py-4 text-sm sm:text-base text-gray-800">{{ $item->harga_format }}</td>
              <td class="px-6 py-4 text-sm sm:text-base text-gray-800">{{ $item->deskripsi }}</td>
              <td class="px-6 py-4 text-sm sm:text-base text-gray-800">{{ $item->kategori }}</td>
              <td class="px-6 py-4 space-x-2">
                <a href="{{ route('produk.edit', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Edit</a>
                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="px-6 py-4 text-sm sm:text-base text-gray-800 text-center">Tidak ada produk tersedia.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($produk instanceof \Illuminate\Pagination\LengthAwarePaginator && $produk->hasPages())
      <div class="flex justify-between items-center mt-6 text-sm sm:text-base text-gray-600">
        <span>Menampilkan {{ $produk->firstItem() }} - {{ $produk->lastItem() }} dari {{ $produk->total() }} produk</span>
        <div class="flex gap-1">
          {{ $produk->links() }}
        </div>
      </div>
      @endif

    @endif

  </div>

</body>

</html>