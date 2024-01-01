  <p class="mt-2">Nama Koordinator: {{ $koordinator->nama_koordinator }}</p>
  <p>Kelurahan: {{ $koordinator->kelurahan }}</p>
  <p>Kecamatan: {{ $koordinator->kecamatan }}</p>
  <p>Jumlah Surat Dukungan: {{ $koordinator->jumlah_surat_dukungan }}</p>
  <p>Total Input: {{ $pemilihRecords->count() }}</p>

  <table class="table table-striped">
      <thead>
          <tr>
              <th>No</th>
              <th>Nama Pemilih</th>
              <th>Kelurahan</th>
              <th>Kecamatan</th>
              <th>RW</th>
              <th>RT</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($pemilihRecords as $key => $pemilih)
          <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $pemilih->nama_pemilih }}</td>
              <td>{{ $pemilih->kelurahan }}</td>
              <td>{{ $pemilih->kecamatan }}</td>
              <td>{{ $pemilih->rw }}</td>
              <td>{{ $pemilih->rt }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
