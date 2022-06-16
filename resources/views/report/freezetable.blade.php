{{-- <style>

    .table-report {
  border-collapse: separate;
  border-spacing: 0;
  border-top: 1px solid grey;
}

.table-report td,
.table-report th {
  margin: 0;
  border: 1px solid grey;
  white-space: nowrap;
  border-top-width: 0px;
}

.main-table {
  width: 500px;
  overflow-x: scroll;
  margin-left: 5em;
  overflow-y: visible;
  padding: 0;
}

.headcol {
  position: absolute;
  width: 5em;
  left: 0;
  top: auto;
  border-top-width: 1px;
  /*only relevant for first row*/
  margin-top: -1px;
  /*compensate for top border*/
}

.headcol:before {
  content: 'Row ';
}

.long {
  background: yellow;
  letter-spacing: 1em;
}
</style>

<div class="main-table">
  <table class="table-report">
    <tr>
      <th class="headcol">1</th>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
    </tr>
    <tr>
      <th class="headcol">2</th>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
    </tr>
    <tr>
      <th class="headcol">3</th>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
    </tr>
    <tr>
      <th class="headcol">4</th>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
    </tr>
    <tr>
      <th class="headcol">5</th>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
    </tr>
    <tr>
      <th class="headcol">6</th>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
      <td class="long">QWERTYUIOPASDFGHJKLZXCVBNM</td>
    </tr>
  </table>
</div> --}}

<style>
    .table-report  {
        text-align: center;
    }

    .table-container {
        width: 800px;
        height: 300px;
        overflow: scroll;
    }

    .table-report  th,
    .table-report  td {
        white-space: nowrap;
        padding: 10px 20px;
        font-family: Arial;
    }

    .table-report  tr th:first-child,
    .table-report  td:first-child,

    .table-report  tr th:nth-child(2),
    .table-report  td:nth-child(2) {
        background-color:red; 
        position: sticky;
        width: 100px;
        left: 0;
        z-index: 10;
        background: #fff;
    }

    .table-report  tr th:first-child {
        z-index: 11;
    }

    .table-report  tr th {
        position: sticky;
        top: 0;
        z-index: 9;
        background: #fff;
    }
</style>
<div class="table-container">
    <table class="table-report table">
        <tr>
            <th width="2" rowspan="2">No. </th>
            <th width="2" colspan="3">Saldo Tahun Lalu </th>

            <th width="2" class="text-center bg-primary" colspan="4"> Triwulan 1 </th>

            <th width="2" class="text-center bg-info" colspan="4"> Triwulan 2 </th>

            <th width="2" class="text-center bg-success" colspan="4"> Triwulan 3 </th>

            <th width="2" class="text-center bg-warning" colspan="4"> Triwulan 4 </th>

            <th width="2" class="text-center bg-secondary" colspan="4"> Total Growth </th>
        </tr>
        <tr>
            <th style="width: 15em">Pemegang Saham </th>
            <th style="width: 13em">Saldo Terakhir (Rp.)</th>
            <th style="width: 10em">% Saham </th>

            <th style="width: 13em" class="bg-primary">Setoran (Rp.)</th>
            <th style="width: 13em" class="bg-primary">Saldo Akhir </th>
            <th style="width: 10em" class="bg-primary">% Saham </th>
            <th style="width: 10em" class="bg-primary">% Growth </th>


            <th width="2" style="width: 13em" class="bg-info">Setoran (Rp.)</th>
            <th width="2" style="width: 13em" class="bg-info">Saldo Akhir </th>
            <th width="2" style="width: 10em" class="bg-info">% Saham </th>
            <th width="2" style="width: 10em" class="bg-info">% Growth </th>

            <th width="2" style="width: 13em" class="bg-success">Setoran (Rp.)</th>
            <th width="2" style="width: 13em" class="bg-success">Saldo Akhir </th>
            <th width="2" style="width: 10em" class="bg-success">% Saham </th>
            <th width="2" style="width: 10em" class="bg-success">% Growth </th>

            <th width="2" style="width: 13em" class="bg-warning">Setoran (Rp.)</th>
            <th width="2" style="width: 13em" class="bg-warning">Saldo Akhir </th>
            <th width="2" style="width: 10em" class="bg-warning">% Saham </th>
            <th width="2" style="width: 10em" class="bg-warning">% Growth </th>

            <th width="2" style="width: 13em" class="bg-secondary">Total Setoran (Rp.)</th>
            <th width="2" style="width: 10em" class="bg-secondary">% Growth </th>

        </tr>
        {{-- <tr><td>H11</td><td>H12</td><td>H13</td><td>H14</td><td>H15</td><td>H16</td><td>H17</td></tr>
				<tr><td>H21</td><td>H22</td><td>H23</td><td>H24</td><td>H25</td><td>H26</td><td>H27</td></tr>
				<tr><td>H31</td><td>H32</td><td>H33</td><td>H34</td><td>H35</td><td>H36</td><td>H37</td></tr>
				<tr><td>H41</td><td>H42</td><td>H44</td><td>H44</td><td>H45</td><td>H46</td><td>H47</td></tr>
				<tr><td>H51</td><td>H52</td><td>H54</td><td>H54</td><td>H55</td><td>H56</td><td>H57</td></tr>
				<tr><td>H61</td><td>H62</td><td>H64</td><td>H64</td><td>H65</td><td>H66</td><td>H67</td></tr>
				<tr><td>H71</td><td>H72</td><td>H74</td><td>H74</td><td>H75</td><td>H76</td><td>H77</td></tr>
				<tr><td>H81</td><td>H82</td><td>H84</td><td>H84</td><td>H85</td><td>H86</td><td>H87</td></tr> --}}
    </table>
</div>
