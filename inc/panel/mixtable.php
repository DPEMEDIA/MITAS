<div class="row">
<div class="col-md-12 mt-4">
<div class="card">
<div class="card-header bg-main">
<i class="fas fa-table"></i> Mischtabelle
<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Mischtabelle"></i></span>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered table-striped mb-0" id="mixtable">
<thead>
<tr>
<th scope="col">Base in ml</th>
<th scope="col">Nikotin (mg / ml)</th>
<th scope="col">Menge - 3 mg</th>
<th scope="col">Menge - 6 mg</th>
<th scope="col">Menge - 9 mg</th>
<th scope="col">Menge - 12 mg</th>
</tr>
</thead>
<tbody>
<tr>
<td>100 ml</td>
<td>20 mg / ml</td>
<td>2</td>
<td>4</td>
<td>5</td>
<td>7</td>
</tr>
<tr>
<td>200 ml</td>
<td>20 mg / ml</td>
<td>3</td>
<td>7</td>
<td>10</td>
<td>13</td>
</tr>
<tr>
<td>300 ml</td>
<td>20 mg / ml</td>
<td>5</td>
<td>10</td>
<td>14</td>
<td>19</td>
</tr>
<tr>
<td>400 ml</td>
<td>20 mg / ml</td>
<td>6</td>
<td>13</td>
<td>19</td>
<td>25</td>
</tr>
<tr>
<td>500 ml</td>
<td>20 mg / ml</td>
<td>8</td>
<td>16</td>
<td>23</td>
<td>31</td>
</tr>
<tr>
<td>600 ml</td>
<td>20 mg / ml</td>
<td>9</td>
<td>19</td>
<td>28</td>
<td>37</td>
</tr>
<tr>
<td>700 ml</td>
<td>20 mg / ml</td>
<td>11</td>
<td>22</td>
<td>32</td>
<td>43</td>
</tr>
<tr>
<td>800 ml</td>
<td>20 mg / ml</td>
<td>12</td>
<td>25</td>
<td>37</td>
<td>49</td>
</tr>
<tr>
<td>900 ml</td>
<td>20 mg / ml</td>
<td>14</td>
<td>28</td>
<td>41</td>
<td>55</td>
</tr>
<tr>
<td>1000 ml</td>
<td>20 mg / ml</td>
<td>15</td>
<td>31</td>
<td>46</td>
<td>61</td>
</tr>
<tr>
<td>1100 ml</td>
<td>20 mg / ml</td>
<td>17</td>
<td>34</td>
<td>50</td>
<td>67</td>
</tr>
<tr>
<td>1200 ml</td>
<td>20 mg / ml</td>
<td>18</td>
<td>37</td>
<td>55</td>
<td>73</td>
</tr>
<tr>
<td>1300 ml</td>
<td>20 mg / ml</td>
<td>20</td>
<td>40</td>
<td>59</td>
<td>79</td>
</tr>
<tr>
<td>1400 ml</td>
<td>20 mg / ml</td>
<td>21</td>
<td>43</td>
<td>64</td>
<td>85</td>
</tr>
<tr>
<td>1500 ml</td>
<td>20 mg / ml</td>
<td>23</td>
<td>46</td>
<td>68</td>
<td>91</td>
</tr>
<tr>
<td>1600 ml</td>
<td>20 mg / ml</td>
<td>24</td>
<td>49</td>
<td>73</td>
<td>97</td>
</tr>
<tr>
<td>1700 ml</td>
<td>20 mg / ml</td>
<td>26</td>
<td>52</td>
<td>77</td>
<td>103</td>
</tr>
<tr>
<td>1800 ml</td>
<td>20 mg / ml</td>
<td>27</td>
<td>55</td>
<td>82</td>
<td>109</td>
</tr>
<tr>
<td>1900 ml</td>
<td>20 mg / ml</td>
<td>29</td>
<td>58</td>
<td>86</td>
<td>115</td>
</tr>
<tr>
<td>2000 ml</td>
<td>20 mg / ml</td>
<td>30</td>
<td>61</td>
<td>91</td>
<td>121</td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-md-12 mt-4">
<button type="button" class="btn btn-block btn-primary" onclick="printData()">Drucken</button>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function printData()
{
   var divToPrint=document.getElementById("mixtable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>
