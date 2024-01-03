  <p class="mt-2">Nama Koordinator: {{ $koordinator->nama_koordinator }}</p>
  <p>Kelurahan: {{ $koordinator->kelurahan }}</p>
  <p>Kecamatan: {{ $koordinator->kecamatan }}</p>
  {{-- <p>Jumlah Surat Dukungan: {{ $koordinator->jumlah_surat_dukungan }}</p> --}}
  <p>Total Input: {{ $pemilihRecords->count() }}</p>

  <table class="table table-striped" border="1" style="border-collapse: collapse">
      <thead>
          <tr>
              <th>No</th>
              <th>Nama Koordinator</th>
              <th>NIK</th>
              <th>Jenis Kelamin</th>
              <th>NO HP</th>
              <th>RT</th>
              <th>RW</th>
              <th>Kelurahan</th>
              {{-- <th>Kecamatan</th> --}}
              <th>NO TPS</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($pemilihRecords as $key => $pemilih)
              <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $pemilih->nama_pemilih }}</td>
                  <td>{{ $pemilih->nik }}</td>
                  <td>{{ $pemilih->jenis_kelamin }}</td>
                  <td>{{ $pemilih->no_hp }}</td>
                  <td>{{ $pemilih->rt }}</td>
                  <td>{{ $pemilih->rw }}</td>
                  <td>{{ $pemilih->kelurahan }}</td>
                  {{-- <td>{{ $pemilih->kecamatan }}</td> --}}
                  <td>{{ $pemilih->tps }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
