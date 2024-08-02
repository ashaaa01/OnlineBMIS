<div class="btn-group" style="margin-right: 10px;">
    <select name="municipal" id="municipal" class="btn btn-sm dropdown-toggle custom-select" onchange="updateBarangayOptions(); submitCombinedForm()">
        <option value="" disabled Selected>Municipality</option>
        <option value="">All</option>
        <option value="Baco" {{ request('municipal') == 'Baco' ? 'selected' : '' }}>Baco</option>
        <option value="Bansud" {{ request('municipal') == 'Bansud' ? 'selected' : '' }}>Bansud</option>
        <option value="Bongabong" {{ request('municipal') == 'Bongabong' ? 'selected' : '' }}>Bongabong</option>
        <option value="Bulalacao" {{ request('municipal') == 'Bulalacao' ? 'selected' : '' }}>Bulalacao</option>
        <option value="Calapan" {{ request('municipal') == 'Calapan' ? 'selected' : '' }}>Calapan</option>
        <option value="Gloria" {{ request('municipal') == 'Gloria' ? 'selected' : '' }}>Gloria</option>
        <option value="Mansalay" {{ request('municipal') == 'Mansalay' ? 'selected' : '' }}>Mansalay</option>
        <option value="Naujan" {{ request('municipal') == 'Naujan' ? 'selected' : '' }}>Naujan</option>
        <option value="Pinamalayan" {{ request('municipal') == 'Pinamalayan' ? 'selected' : '' }}>Pinamalayan</option>
        <option value="Pola" {{ request('municipal') == 'Pola' ? 'selected' : '' }}>Pola</option>
        <option value="Puerto Galera" {{ request('municipal') == 'Puerto Galera' ? 'selected' : '' }}>Puerto Galera</option>
        <option value="Roxas" {{ request('municipal') == 'Roxas' ? 'selected' : '' }}>Roxas</option>
        <option value="San Teodoro" {{ request('municipal') == 'San Teodoro' ? 'selected' : '' }}>San Teodoro</option>
        <option value="Socorro" {{ request('municipal') == 'Socorro' ? 'selected' : '' }}>Socorro</option>
        <option value="Victoria" {{ request('municipal') == 'Victoria' ? 'selected' : '' }}>Victoria</option>
    </select>
</div>

    <optgroup id="barangay-baco" style="display: none;">
        <option value="Alag" {{ request('bar_angay') == 'Alag' ? 'selected' : '' }} data-municipality="Baco">Alag</option>
        <option value="Bangkatan" {{ request('bar_angay') == 'Bangkatan' ? 'selected' : '' }} data-municipality="Baco">Bangkatan</option>
        <option value="Baras" {{ request('bar_angay') == 'Baras' ? 'selected' : '' }} data-municipality="Baco">Baras</option>
        <option value="Bayanan" {{ request('bar_angay') == 'Bayanan' ? 'selected' : '' }} data-municipality="Baco">Bayanan</option>
        <option value="Burbuli" {{ request('bar_angay') == 'Burbuli' ? 'selected' : '' }} data-municipality="Baco">Burbuli</option>
        <option value="Catwiran I" {{ request('bar_angay') == 'Catwiran I' ? 'selected' : '' }} data-municipality="Baco">Catwiran I</option>
        <option value="Catwiran II" {{ request('bar_angay') == 'Catwiran II' ? 'selected' : '' }} data-municipality="Baco">Catwiran II</option>
        <option value="Dulangan I" {{ request('bar_angay') == 'Dulangan I' ? 'selected' : '' }} data-municipality="Baco">Dulangan I</option>
        <option value="Dulangan II" {{ request('bar_angay') == 'Dulangan II' ? 'selected' : '' }} data-municipality="Baco">Dulangan II</option>
        <option value="Lantuyang" {{ request('bar_angay') == 'Lantuyang' ? 'selected' : '' }} data-municipality="Baco">Lantuyang</option>
        <option value="Lumang Bayan" {{ request('bar_angay') == 'Lumang Bayan' ? 'selected' : '' }} data-municipality="Baco">Lumang Bayan</option>
        <option value="Malapad" {{ request('bar_angay') == 'Malapad' ? 'selected' : '' }} data-municipality="Baco">Malapad</option>
        <option value="Mangangan I" {{ request('bar_angay') == 'Mangangan I' ? 'selected' : '' }} data-municipality="Baco">Mangangan I</option>
        <option value="Mangangan II" {{ request('bar_angay') == 'Mangangan II' ? 'selected' : '' }} data-municipality="Baco">Mangangan II</option>
        <option value="Mayabig" {{ request('bar_angay') == 'Mayabig' ? 'selected' : '' }} data-municipality="Baco">Mayabig</option>
        <option value="Pambisan" {{ request('bar_angay') == 'Pambisan' ? 'selected' : '' }} data-municipality="Baco">Pambisan</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="Baco">Poblacion</option>
        <option value="Pulang-Tubig" {{ request('bar_angay') == 'Pulang-Tubig' ? 'selected' : '' }} data-municipality="Baco">Pulang-Tubig</option>
        <option value="Putican-Cabulo" {{ request('bar_angay') == 'Putican-Cabulo' ? 'selected' : '' }} data-municipality="Baco">Putican-Cabulo</option>
        <option value="San Andres" {{ request('bar_angay') == 'San Andres' ? 'selected' : '' }} data-municipality="Baco">San Andres</option>
        <option value="San Ignacio" {{ request('bar_angay') == 'San Ignacio' ? 'selected' : '' }} data-municipality="Baco">San Ignacio</option>
        <option value="Santa Cruz" {{ request('bar_angay') == 'Santa Cruz' ? 'selected' : '' }} data-municipality="Baco">Santa Cruz</option>
        <option value="Santa Rosa I" {{ request('bar_angay') == 'Santa Rosa I' ? 'selected' : '' }} data-municipality="Baco">Santa Rosa I</option>
        <option value="Santa Rosa II" {{ request('bar_angay') == 'Santa Rosa II' ? 'selected' : '' }} data-municipality="Baco">Santa Rosa II</option>
        <option value="Tabon-tabon" {{ request('bar_angay') == 'Tabon-tabon' ? 'selected' : '' }} data-municipality="Baco">Tabon-tabon</option>
        <option value="Tagumpay" {{ request('bar_angay') == 'Tagumpay' ? 'selected' : '' }} data-municipality="Baco">Tagumpay</option>
        <option value="Water" {{ request('bar_angay') == 'Water' ? 'selected' : '' }} data-municipality="Baco">Water</option>
    </optgroup>
    
    <optgroup id="barangay-bansud" style="display: none;">  
    <option value="Alacdesma" {{ request('bar_angay') == 'Alcadesma' ? 'selected' : '' }} data-municipality="Bansud">Alcadesma</option>    
        <option value="Bato" {{ request('bar_angay') == 'Bato' ? 'selected' : '' }} data-municipality="Bansud">Bato</option>
        <option value="Conrazon" {{ request('bar_angay') == 'Conrazon' ? 'selected' : '' }} data-municipality="Bansud">Conrazon</option>
        <option value="Malo" {{ request('bar_angay') == 'Malo' ? 'selected' : '' }} data-municipality="Bansud">Malo</option>
        <option value="Manihala" {{ request('bar_angay') == 'Manihala' ? 'selected' : '' }} data-municipality="Bansud">Manihala</option>
        <option value="Pag-asa" {{ request('bar_angay') == 'Pag-asa' ? 'selected' : '' }} data-municipality="Bansud">Pag-asa</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="Bansud">Poblacion</option>
        <option value="Proper Bansud" {{ request('bar_angay') == 'Proper Bansud' ? 'selected' : '' }} data-municipality="Bansud">Proper Bansud</option>
        <option value="Proper Tiguisan" {{ request('bar_angay') == 'Proper Tiguisan' ? 'selected' : '' }} data-municipality="Bansud">Proper Tiguisan</option>
        <option value="Rosacara" {{ request('bar_angay') == 'Rosacara' ? 'selected' : '' }} data-municipality="Bansud">Rosacara</option>
        <option value="Salcedo" {{ request('bar_angay') == 'Salcedo' ? 'selected' : '' }} data-municipality="Bansud">Salcedo</option>
        <option value="Sumagui" {{ request('bar_angay') == 'Sumagui' ? 'selected' : '' }} data-municipality="Bansud">Sumagui</option>
        <option value="Villa Pag-asa" {{ request('bar_angay') == 'Villa Pag-asa' ? 'selected' : '' }} data-municipality="Bansud">Villa Pag-asa</option>
    </optgroup>

    <optgroup id="barangay-bongabong" style="display: none;">
        <option value="Anilao" {{ request('bar_angay') == 'Anilao' ? 'selected' : '' }} data-municipality="Bongabong">Anilao</option>
        <option value="Aplaya" {{ request('bar_angay') == 'Aplaya' ? 'selected' : '' }} data-municipality="Bongabong">Aplaya</option>
        <option value="Bagumbayan I" {{ request('bar_angay') == 'Bagumbayan I' ? 'selected' : '' }} data-municipality="Bongabong">Bagumbayan I</option>
        <option value="Bagumbayan II" {{ request('bar_angay') == 'Bagumbayan II' ? 'selected' : '' }} data-municipality="Bongabong">Bagumbayan II</option>
        <option value="Batangan" {{ request('bar_angay') == 'Batangan' ? 'selected' : '' }} data-municipality="Bongabong">Batangan</option>
        <option value="Bukal" {{ request('bar_angay') == 'Bukal' ? 'selected' : '' }} data-municipality="Bongabong">Bukal</option>
        <option value="Camantigue" {{ request('bar_angay') == 'Camantigue' ? 'selected' : '' }} data-municipality="Bongabong">Camantigue</option>
        <option value="Carmundo" {{ request('bar_angay') == 'Carmundo' ? 'selected' : '' }} data-municipality="Bongabong">Carmundo</option>
        <option value="Cawayan" {{ request('bar_angay') == 'Cawayan' ? 'selected' : '' }} data-municipality="Bongabong">Cawayan</option>
        <option value="Dayhagan" {{ request('bar_angay') == 'Dayhagan' ? 'selected' : '' }} data-municipality="Bongabong">Dayhagan</option>
        <option value="Formon" {{ request('bar_angay') == 'Formon' ? 'selected' : '' }} data-municipality="Bongabong">Formon</option>
        <option value="Hagan" {{ request('bar_angay') == 'Hagan' ? 'selected' : '' }} data-municipality="Bongabong">Hagan</option>
        <option value="Hagupit" {{ request('bar_angay') == 'Hagupit' ? 'selected' : '' }} data-municipality="Bongabong">Hagupit</option>
        <option value="Ipil" {{ request('bar_angay') == 'Ipil' ? 'selected' : '' }} data-municipality="Bongabong">Ipil</option>
        <option value="Kaligtasan" {{ request('bar_angay') == 'Kaligtasan' ? 'selected' : '' }} data-municipality="Bongabong">Kaligtasan</option>
        <option value="Labasan" {{ request('bar_angay') == 'Labasan' ? 'selected' : '' }} data-municipality="Bongabong">Labasan</option>
        <option value="Labonan" {{ request('bar_angay') == 'Labonan' ? 'selected' : '' }} data-municipality="Bongabong">Labonan</option>
        <option value="Libertad" {{ request('bar_angay') == 'Libertad' ? 'selected' : '' }} data-municipality="Bongabong">Libertad</option>
        <option value="Lisap" {{ request('bar_angay') == 'Lisap' ? 'selected' : '' }} data-municipality="Bongabong">Lisap</option>
        <option value="Luna" {{ request('bar_angay') == 'Luna' ? 'selected' : '' }} data-municipality="Bongabong">Luna</option>
        <option value="Malitbog" {{ request('bar_angay') == 'Malitbog' ? 'selected' : '' }} data-municipality="Bongabong">Malitbog</option>
        <option value="Mapang" {{ request('bar_angay') == 'Mapang' ? 'selected' : '' }} data-municipality="Bongabong">Mapang</option>
        <option value="Masaguisi" {{ request('bar_angay') == 'Masaguisi' ? 'selected' : '' }} data-municipality="Bongabong">Masaguisi</option>
        <option value="Mina de Oro" {{ request('bar_angay') == 'Mina de Oro' ? 'selected' : '' }} data-municipality="Bongabong">Mina de Oro</option>
        <option value="Morente" {{ request('bar_angay') == 'Morente' ? 'selected' : '' }} data-municipality="Bongabong">Morente</option>
        <option value="Ogbot" {{ request('bar_angay') == 'Ogbot' ? 'selected' : '' }} data-municipality="Bongabong">Ogbot</option>
        <option value="Orconuma" {{ request('bar_angay') == 'Orconuma' ? 'selected' : '' }} data-municipality="Bongabong">Orconuma</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="Bongabong">Poblacion</option>
        <option value="Polusahi" {{ request('bar_angay') == 'Polusahi' ? 'selected' : '' }} data-municipality="Bongabong">Polusahi</option>
        <option value="Sagana" {{ request('bar_angay') == 'Sagana' ? 'selected' : '' }} data-municipality="Bongabong">Sagana</option>
        <option value="San Isidro" {{ request('bar_angay') == 'San Isidro' ? 'selected' : '' }} data-municipality="Bongabong">San Isidro</option>
        <option value="San Jose" {{ request('bar_angay') == 'San Jose' ? 'selected' : '' }} data-municipality="Bongabong">San Jose</option>
        <option value="San Juan" {{ request('bar_angay') == 'San Juan' ? 'selected' : '' }} data-municipality="Bongabong">San Juan</option>
        <option value="Santa Cruz" {{ request('bar_angay') == 'Santa Cruz' ? 'selected' : '' }} data-municipality="Bongabong">Santa Cruz</option>
        <option value="Sigange" {{ request('bar_angay') == 'Sigange' ? 'selected' : '' }} data-municipality="Bongabong">Sigange</option>
        <option value="Tawas" {{ request('bar_angay') == 'Tawas' ? 'selected' : '' }} data-municipality="Bongabong">Tawas</option>
    </optgroup>

    <optgroup id="barangay-bulalacao" style="display: none;">
        <option value="Bagong Sikat" {{ request('bar_angay') == 'Bagong Sikat' ? 'selected' : '' }} data-municipality="Bulalacao">Bagong Sikat</option>
        <option value="Balatasan" {{ request('bar_angay') == 'Balatasan' ? 'selected' : '' }} data-municipality="Bulalacao">Balatasan</option>
        <option value="Benli" {{ request('bar_angay') == 'Benli' ? 'selected' : '' }} data-municipality="Bulalacao">Benli</option>
        <option value="Cabugao" {{ request('bar_angay') == 'Cabugao' ? 'selected' : '' }} data-municipality="Bulalacao">Cabugao</option>
        <option value="Cambunang" {{ request('bar_angay') == 'Cambunang' ? 'selected' : '' }} data-municipality="Bulalacao">Cambunang</option>
        <option value="Campaasan" {{ request('bar_angay') == 'Campaasan' ? 'selected' : '' }} data-municipality="Bulalacao">Campaasan</option>
        <option value="Maasin" {{ request('bar_angay') == 'Maasin' ? 'selected' : '' }} data-municipality="Bulalacao">Maasin</option>
        <option value="Maujao" {{ request('bar_angay') == 'Maujao' ? 'selected' : '' }} data-municipality="Bulalacao">Maujao</option>
        <option value="Milagrosa" {{ request('bar_angay') == 'Milagrosa' ? 'selected' : '' }} data-municipality="Bulalacao">Milagrosa</option>
        <option value="Nasukob" {{ request('bar_angay') == 'Nasukob' ? 'selected' : '' }} data-municipality="Bulalacao">Nasukob</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="Bulalacao">Poblacion</option>
        <option value="San Francisco" {{ request('bar_angay') == 'San Francisco' ? 'selected' : '' }} data-municipality="Bulalacao">San Francisco</option>
        <option value="San Isidro" {{ request('bar_angay') == 'San Isidro' ? 'selected' : '' }} data-municipality="Bulalacao">San Isidro</option>
        <option value="San Juan" {{ request('bar_angay') == 'San Juan' ? 'selected' : '' }} data-municipality="Bulalacao">San Juan</option>
        <option value="San Roque" {{ request('bar_angay') == 'San Roque' ? 'selected' : '' }} data-municipality="Bulalacao">San Roque</option>
    </optgroup>

    <optgroup id="barangay-calapan city" style="display: none;">
        <option value="Balingayan" {{ request('bar_angay') == 'Balingayan' ? 'selected' : '' }} data-municipality="Calapan">Balingayan</option>
        <option value="Balite" {{ request('bar_angay') == 'Balite' ? 'selected' : '' }} data-municipality="Calapan">Balite</option>
        <option value="Baruyan" {{ request('bar_angay') == 'Baruyan' ? 'selected' : '' }} data-municipality="Calapan">Baruyan</option>
        <option value="Batino" {{ request('bar_angay') == 'Batino' ? 'selected' : '' }} data-municipality="Calapan">Batino</option>
        <option value="Bayanan I" {{ request('bar_angay') == 'Bayanan I' ? 'selected' : '' }} data-municipality="Calapan">Bayanan I</option>
        <option value="Bayanan II" {{ request('bar_angay') == 'Bayanan II' ? 'selected' : '' }} data-municipality="Calapan">Bayanan II</option>
        <option value="Biga" {{ request('bar_angay') == 'Biga' ? 'selected' : '' }} data-municipality="Calapan">Biga</option>
        <option value="Bondoc" {{ request('bar_angay') == 'Bondoc' ? 'selected' : '' }} data-municipality="Calapan">Bondoc</option>
        <option value="Bucayao" {{ request('bar_angay') == 'Bucayao' ? 'selected' : '' }} data-municipality="Calapan">Bucayao</option>
        <option value="Buhuan" {{ request('bar_angay') == 'Buhuan' ? 'selected' : '' }} data-municipality="Calapan">Buhuan</option>
        <option value="Bulusan" {{ request('bar_angay') == 'Bulusan' ? 'selected' : '' }} data-municipality="Calapan">Bulusan</option>
        <option value="Calero" {{ request('bar_angay') == 'Calero' ? 'selected' : '' }} data-municipality="Calapan">Calero</option>
        <option value="Camansihan" {{ request('bar_angay') == 'Camansihan' ? 'selected' : '' }} data-municipality="Calapan">Camansihan</option>
        <option value="Camilmil" {{ request('bar_angay') == 'Camilmil' ? 'selected' : '' }} data-municipality="Calapan">Camilmil</option>
        <option value="Canubing I" {{ request('bar_angay') == 'Canubing I' ? 'selected' : '' }} data-municipality="Calapan">Canubing I</option>
        <option value="Canubing II" {{ request('bar_angay') == 'Canubing II' ? 'selected' : '' }} data-municipality="Calapan">Canubing II</option>
        <option value="Comunal" {{ request('bar_angay') == 'Comunal' ? 'selected' : '' }} data-municipality="Calapan">Comunal</option>
        <option value="Guinobatan" {{ request('bar_angay') == 'Guinobatan' ? 'selected' : '' }} data-municipality="Calapan">Guinobatan</option>
        <option value="Gulod" {{ request('bar_angay') == 'Gulod' ? 'selected' : '' }} data-municipality="Calapan">Gulod</option>
        <option value="Gutad" {{ request('bar_angay') == 'Gutad' ? 'selected' : '' }} data-municipality="Calapan">Gutad</option>
        <option value="Ibaba East" {{ request('bar_angay') == 'Ibaba East' ? 'selected' : '' }} data-municipality="Calapan">Ibaba East</option>
        <option value="Ibaba West" {{ request('bar_angay') == 'Ibaba West' ? 'selected' : '' }} data-municipality="Calapan">Ibaba West</option>
        <option value="Ilaya" {{ request('bar_angay') == 'Ilaya' ? 'selected' : '' }} data-municipality="Calapan">Ilaya</option>
        <option value="Lalud" {{ request('bar_angay') == 'Lalud' ? 'selected' : '' }} data-municipality="Calapan">Lalud</option>
        <option value="Lazareto" {{ request('bar_angay') == 'Lazareto' ? 'selected' : '' }} data-municipality="Calapan">Lazareto</option>
        <option value="Libis" {{ request('bar_angay') == 'Libis' ? 'selected' : '' }} data-municipality="Calapan">Libis</option>
        <option value="Lumang Bayan" {{ request('bar_angay') == 'Lumang Bayan' ? 'selected' : '' }} data-municipality="Calapan">Lumang Bayan</option>
        <option value="Mahal na Pangalan" {{ request('bar_angay') == 'Mahal na Pangalan' ? 'selected' : '' }} data-municipality="Calapan">Mahal na Pangalan</option>
        <option value="Maidlang" {{ request('bar_angay') == 'Maidlang' ? 'selected' : '' }} data-municipality="Calapan">Maidlang</option>
        <option value="Malad" {{ request('bar_angay') == 'Malad' ? 'selected' : '' }} data-municipality="Calapan">Malad</option>
        <option value="Malamig" {{ request('bar_angay') == 'Malamig' ? 'selected' : '' }} data-municipality="Calapan">Malamig</option>
        <option value="Managpi" {{ request('bar_angay') == 'Managpi' ? 'selected' : '' }} data-municipality="Calapan">Managpi</option>
        <option value="Masipit" {{ request('bar_angay') == 'Masipit' ? 'selected' : '' }} data-municipality="Calapan">Masipit</option>
        <option value="Nag-iba I" {{ request('bar_angay') == 'Nag-iba I' ? 'selected' : '' }} data-municipality="Calapan">Nag-iba I</option>
        <option value="Nag-iba II" {{ request('bar_angay') == 'Nag-iba II' ? 'selected' : '' }} data-municipality="Calapan">Nag-iba II</option>
        <option value="Navotas" {{ request('bar_angay') == 'Navotas' ? 'selected' : '' }} data-municipality="Calapan">Navotas</option>
        <option value="Pachoca" {{ request('bar_angay') == 'Pachoca' ? 'selected' : '' }} data-municipality="Calapan">Pachoca</option>
        <option value="Palhi" {{ request('bar_angay') == 'Palhi' ? 'selected' : '' }} data-municipality="Calapan">Palhi</option>
        <option value="Panggalaan" {{ request('bar_angay') == 'Panggalaan' ? 'selected' : '' }} data-municipality="Calapan">Panggalaan</option>
        <option value="Parang" {{ request('bar_angay') == 'Parang' ? 'selected' : '' }} data-municipality="Calapan">Parang</option>
        <option value="Patas" {{ request('bar_angay') == 'Patas' ? 'selected' : '' }} data-municipality="Calapan">Patas</option>
        <option value="Personas" {{ request('bar_angay') == 'Personas' ? 'selected' : '' }} data-municipality="Calapan">Personas</option>
        <option value="Putingtubig" {{ request('bar_angay') == 'Putingtubig' ? 'selected' : '' }} data-municipality="Calapan">Putingtubig</option>
        <option value="Salong" {{ request('bar_angay') == 'Salong' ? 'selected' : '' }} data-municipality="Calapan">Salong</option>
        <option value="San Antonio" {{ request('bar_angay') == 'San Antonio' ? 'selected' : '' }} data-municipality="Calapan">San Antonio</option>
        <option value="San Vicente Central" {{ request('bar_angay') == 'San Vicente Central' ? 'selected' : '' }} data-municipality="Calapan">San Vicente Central</option>
        <option value="San Vicente East" {{ request('bar_angay') == 'San Vicente East' ? 'selected' : '' }} data-municipality="Calapan">San Vicente East</option>
        <option value="San Vicente North" {{ request('bar_angay') == 'San Vicente North' ? 'selected' : '' }} data-municipality="Calapan">San Vicente North</option>
        <option value="San Vicente South" {{ request('bar_angay') == 'San Vicente South' ? 'selected' : '' }} data-municipality="Calapan">San Vicente South</option>
        <option value="San Vicente West" {{ request('bar_angay') == 'San Vicente West' ? 'selected' : '' }} data-municipality="Calapan">San Vicente West</option>
        <option value="Santa Cruz" {{ request('bar_angay') == 'Santa Cruz' ? 'selected' : '' }} data-municipality="Calapan">Santa Cruz</option>
        <option value="Santa Isabel" {{ request('bar_angay') == 'Santa Isabel' ? 'selected' : '' }} data-municipality="Calapan">Santa Isabel</option>
        <option value="Santa Maria Village" {{ request('bar_angay') == 'Santa Maria Village' ? 'selected' : '' }} data-municipality="Calapan">Santa Maria Village</option>
        <option value="Santa Rita" {{ request('bar_angay') == 'Santa Rita' ? 'selected' : '' }} data-municipality="Calapan">Santa Rita</option>
        <option value="Santo Niño" {{ request('bar_angay') == 'Santo Niño' ? 'selected' : '' }} data-municipality="Calapan">Santo Niño</option>
        <option value="Sapul" {{ request('bar_angay') == 'Sapul' ? 'selected' : '' }} data-municipality="Calapan">Sapul</option>
        <option value="Silonay" {{ request('bar_angay') == 'Silonay' ? 'selected' : '' }} data-municipality="Calapan">Silonay</option>
        <option value="Suqui" {{ request('bar_angay') == 'Suqui' ? 'selected' : '' }} data-municipality="Calapan">Suqui</option>
        <option value="Tawagan" {{ request('bar_angay') == 'Tawagan' ? 'selected' : '' }} data-municipality="Calapan">Tawagan</option>
        <option value="Tawiran" {{ request('bar_angay') == 'Tawiran' ? 'selected' : '' }} data-municipality="Calapan">Tawiran</option>
        <option value="Tibag" {{ request('bar_angay') == 'Tibag' ? 'selected' : '' }} data-municipality="Calapan">Tibag</option>
        <option value="Wawa" {{ request('bar_angay') == 'Wawa' ? 'selected' : '' }} data-municipality="Calapan">Wawa</option>
    </optgroup>

    <optgroup id="barangay-gloria" style="display: none;">
        <option value="Agos" {{ request('bar_angay') == 'Agos' ? 'selected' : '' }} data-municipality="Gloria">Agos</option>
        <option value="Agsalin" {{ request('bar_angay') == 'Agsalin' ? 'selected' : '' }} data-municipality="Gloria">Agsalin</option>
        <option value="Alma Villa" {{ request('bar_angay') == 'Alma Villa' ? 'selected' : '' }} data-municipality="Gloria">Alma Villa</option>
        <option value="Andres Bonifacio" {{ request('bar_angay') == 'Andres Bonifacio' ? 'selected' : '' }} data-municipality="Gloria">Andres Bonifacio</option>
        <option value="Balete" {{ request('bar_angay') == 'Balete' ? 'selected' : '' }} data-municipality="Gloria">Balete</option>
        <option value="Banus" {{ request('bar_angay') == 'Banus' ? 'selected' : '' }} data-municipality="Gloria">Banus</option>
        <option value="Banutan" {{ request('bar_angay') == 'Banutan' ? 'selected' : '' }} data-municipality="Gloria">Banutan</option>
        <option value="Bulaklakan" {{ request('bar_angay') == 'Bulaklakan' ? 'selected' : '' }} data-municipality="Gloria">Bulaklakan</option>
        <option value="Buong Lupa" {{ request('bar_angay') == 'Buong Lupa' ? 'selected' : '' }} data-municipality="Gloria">Buong Lupa</option>
        <option value="Gaudencio Antonino" {{ request('bar_angay') == 'Gaudencio Antonino' ? 'selected' : '' }} data-municipality="Gloria">Gaudencio Antonino</option>
        <option value="Guimbonan" {{ request('bar_angay') == 'Guimbonan' ? 'selected' : '' }} data-municipality="Gloria">Guimbonan</option>
        <option value="Kawit" {{ request('bar_angay') == 'Kawit' ? 'selected' : '' }} data-municipality="Gloria">Kawit</option>
        <option value="Lucio Laurel" {{ request('bar_angay') == 'Lucio Laurel' ? 'selected' : '' }} data-municipality="Gloria">Lucio Laurel</option>
        <option value="Macario Adriatico" {{ request('bar_angay') == 'Macario Adriatico' ? 'selected' : '' }} data-municipality="Gloria">Macario Adriatico</option>
        <option value="Malamig" {{ request('bar_angay') == 'Malamig' ? 'selected' : '' }} data-municipality="Gloria">Malamig</option>
        <option value="Malayong" {{ request('bar_angay') == 'Malayong' ? 'selected' : '' }} data-municipality="Gloria">Malayong</option>
        <option value="Maligaya" {{ request('bar_angay') == 'Maligaya' ? 'selected' : '' }} data-municipality="Gloria">Maligaya</option>
        <option value="Malubay" {{ request('bar_angay') == 'Malubay' ? 'selected' : '' }} data-municipality="Gloria">Malubay</option>
        <option value="Manguyang" {{ request('bar_angay') == 'Manguyang' ? 'selected' : '' }} data-municipality="Gloria">Manguyang</option>
        <option value="Maragooc" {{ request('bar_angay') == 'Maragooc' ? 'selected' : '' }} data-municipality="Gloria">Maragooc</option>
        <option value="Mirayan" {{ request('bar_angay') == 'Mirayan' ? 'selected' : '' }} data-municipality="Gloria">Mirayan</option>
        <option value="Narra" {{ request('bar_angay') == 'Narra' ? 'selected' : '' }} data-municipality="Gloria">Narra</option>
        <option value="Papandungin" {{ request('bar_angay') == 'Papandungin' ? 'selected' : '' }} data-municipality="Gloria">Papandungin</option>
        <option value="San Antonio" {{ request('bar_angay') == 'San Antonio' ? 'selected' : '' }} data-municipality="Gloria">San Antonio</option>
        <option value="Santa Maria" {{ request('bar_angay') == 'Santa Maria' ? 'selected' : '' }} data-municipality="Gloria">Santa Maria</option>
        <option value="Santa Theresa" {{ request('bar_angay') == 'Santa Theresa' ? 'selected' : '' }} data-municipality="Gloria">Santa Theresa</option>
        <option value="Tambong" {{ request('bar_angay') == 'Tambong' ? 'selected' : '' }} data-municipality="Gloria">Tambong</option>
    </optgroup>

    <optgroup id="barangay-mansalay" style="display: none;">
        <option value="B. del Mundo" {{ request('bar_angay') == 'B. del Mundo' ? 'selected' : '' }} data-municipality="Mansalay">B. del Mundo</option>
        <option value="Balugo" {{ request('bar_angay') == 'Balugo' ? 'selected' : '' }} data-municipality="Mansalay">Balugo</option>
        <option value="Bonbon" {{ request('bar_angay') == 'Bonbon' ? 'selected' : '' }} data-municipality="Mansalay">Bonbon</option>
        <option value="Budburan" {{ request('bar_angay') == 'Budburan' ? 'selected' : '' }} data-municipality="Mansalay">Budburan</option>
        <option value="Cabalwa" {{ request('bar_angay') == 'Cabalwa' ? 'selected' : '' }} data-municipality="Mansalay">Cabalwa</option>
        <option value="Don Pedro" {{ request('bar_angay') == 'Don Pedro' ? 'selected' : '' }} data-municipality="Mansalay">Don Pedro</option>
        <option value="Maliwanag" {{ request('bar_angay') == 'Maliwanag' ? 'selected' : '' }} data-municipality="Mansalay">Maliwanag</option>
        <option value="Manaul" {{ request('bar_angay') == 'Manaul' ? 'selected' : '' }} data-municipality="Mansalay">Manaul</option>
        <option value="Panaytayan" {{ request('bar_angay') == 'Panaytayan' ? 'selected' : '' }} data-municipality="Mansalay">Panaytayan</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="Mansalay">Poblacion</option>
        <option value="Roma" {{ request('bar_angay') == 'Roma' ? 'selected' : '' }} data-municipality="Mansalay">Roma</option>
        <option value="Santa Brigida" {{ request('bar_angay') == 'Santa Brigida' ? 'selected' : '' }} data-municipality="Mansalay">Santa Brigida</option>
        <option value="Santa Maria" {{ request('bar_angay') == 'Santa Maria' ? 'selected' : '' }} data-municipality="Mansalay">Santa Maria</option>
        <option value="Santa Teresita" {{ request('bar_angay') == 'Santa Teresita' ? 'selected' : '' }} data-municipality="Mansalay">Santa Teresita</option>
        <option value="Villa Celestial" {{ request('bar_angay') == 'Villa Celestial' ? 'selected' : '' }} data-municipality="Mansalay">Villa Celestial</option>
        <option value="Wasig" {{ request('bar_angay') == 'Wasig' ? 'selected' : '' }} data-municipality="Mansalay">Wasig</option>
        <option value="Waygan" {{ request('bar_angay') == 'Waygan' ? 'selected' : '' }} data-municipality="Mansalay">Waygan</option>
    </optgroup>


    <optgroup id="barangay-naujan" style="display: none;">
        <option value="Adrialuna" {{ request('bar_angay') == 'Adrialuna' ? 'selected' : '' }} data-municipality="Naujan">Adrialuna</option>
        <option value="Andres Ilagan" {{ request('bar_angay') == 'Andres Ilagan' ? 'selected' : '' }} data-municipality="Naujan">Andres Ilagan</option>
        <option value="Antipolo" {{ request('bar_angay') == 'Antipolo' ? 'selected' : '' }} data-municipality="Naujan">Antipolo</option>
        <option value="Apitong" {{ request('bar_angay') == 'Apitong' ? 'selected' : '' }} data-municipality="Naujan">Apitong</option>
        <option value="Arangin" {{ request('bar_angay') == 'Arangin' ? 'selected' : '' }} data-municipality="Naujan">Arangin</option>
        <option value="Aurora" {{ request('bar_angay') == 'Aurora' ? 'selected' : '' }} data-municipality="Naujan">Aurora</option>
        <option value="Bacungan" {{ request('bar_angay') == 'Bacungan' ? 'selected' : '' }} data-municipality="Naujan">Bacungan</option>
        <option value="Bagong Buhay" {{ request('bar_angay') == 'Bagong Buhay' ? 'selected' : '' }} data-municipality="Naujan">Bagong Buhay</option>
        <option value="Balite" {{ request('bar_angay') == 'Balite' ? 'selected' : '' }} data-municipality="Naujan">Balite</option>
        <option value="Bancuro" {{ request('bar_angay') == 'Bancuro' ? 'selected' : '' }} data-municipality="Naujan">Bancuro</option>
        <option value="Banuton" {{ request('bar_angay') == 'Banuton' ? 'selected' : '' }} data-municipality="Naujan">Banuton</option>
        <option value="Barcenaga" {{ request('bar_angay') == 'Barcenaga' ? 'selected' : '' }} data-municipality="Naujan">Barcenaga</option>
        <option value="Bayani" {{ request('bar_angay') == 'Bayani' ? 'selected' : '' }} data-municipality="Naujan">Bayani</option>
        <option value="Buhangin" {{ request('bar_angay') == 'Buhangin' ? 'selected' : '' }} data-municipality="Naujan">Buhangin</option>
        <option value="Caburo" {{ request('bar_angay') == 'Caburo' ? 'selected' : '' }} data-municipality="Naujan">Caburo</option>
        <option value="Concepcion" {{ request('bar_angay') == 'Concepcion' ? 'selected' : '' }} data-municipality="Naujan">Concepcion</option>
        <option value="Dao" {{ request('bar_angay') == 'Dao' ? 'selected' : '' }} data-municipality="Naujan">Dao</option>
        <option value="Del Pilar" {{ request('bar_angay') == 'Del Pilar' ? 'selected' : '' }} data-municipality="Naujan">Del Pilar</option>
        <option value="Estrella" {{ request('bar_angay') == 'Estrella' ? 'selected' : '' }} data-municipality="Naujan">Estrella</option>
        <option value="Evangelista" {{ request('bar_angay') == 'Evangelista' ? 'selected' : '' }} data-municipality="Naujan">Evangelista</option>
        <option value="Gamao" {{ request('bar_angay') == 'Gamao' ? 'selected' : '' }} data-municipality="Naujan">Gamao</option>
        <option value="General Esco" {{ request('bar_angay') == 'General Esco' ? 'selected' : '' }} data-municipality="Naujan">General Esco</option>
        <option value="Herrera" {{ request('bar_angay') == 'Herrera' ? 'selected' : '' }} data-municipality="Naujan">Herrera</option>
        <option value="Inarawan" {{ request('bar_angay') == 'Inarawan' ? 'selected' : '' }} data-municipality="Naujan">Inarawan</option>
        <option value="Kalinisan" {{ request('bar_angay') == 'Kalinisan' ? 'selected' : '' }} data-municipality="Naujan">Kalinisan</option>
        <option value="Laguna" {{ request('bar_angay') == 'Laguna' ? 'selected' : '' }} data-municipality="Naujan">Laguna</option>
        <option value="Mabini" {{ request('bar_angay') == 'Mabini' ? 'selected' : '' }} data-municipality="Naujan">Mabini</option>
        <option value="Magtibay" {{ request('bar_angay') == 'Magtibay' ? 'selected' : '' }} data-municipality="Naujan">Magtibay</option>
        <option value="Mahabang Parang" {{ request('bar_angay') == 'Mahabang Parang' ? 'selected' : '' }} data-municipality="Naujan">Mahabang Parang</option>
        <option value="Malaya" {{ request('bar_angay') == 'Malaya' ? 'selected' : '' }} data-municipality="Naujan">Malaya</option>
        <option value="Malinao" {{ request('bar_angay') == 'Malinao' ? 'selected' : '' }} data-municipality="Naujan">Malinao</option>
        <option value="Malvar" {{ request('bar_angay') == 'Malvar' ? 'selected' : '' }} data-municipality="Naujan">Malvar</option>
        <option value="Masagana" {{ request('bar_angay') == 'Masagana' ? 'selected' : '' }} data-municipality="Naujan">Masagana</option>
        <option value="Masaguing" {{ request('bar_angay') == 'Masaguing' ? 'selected' : '' }} data-municipality="Naujan">Masaguing</option>
        <option value="Melgar A" {{ request('bar_angay') == 'Melgar A' ? 'selected' : '' }} data-municipality="Naujan">Melgar A</option>
        <option value="Melgar B" {{ request('bar_angay') == 'Melgar B' ? 'selected' : '' }} data-municipality="Naujan">Melgar B</option>
        <option value="Metolza" {{ request('bar_angay') == 'Metolza' ? 'selected' : '' }} data-municipality="Naujan">Metolza</option>
        <option value="Montelago" {{ request('bar_angay') == 'Montelago' ? 'selected' : '' }} data-municipality="Naujan">Montelago</option>
        <option value="Montemayor" {{ request('bar_angay') == 'Montemayor' ? 'selected' : '' }} data-municipality="Naujan">Montemayor</option>
        <option value="Motoderazo" {{ request('bar_angay') == 'Motoderazo' ? 'selected' : '' }} data-municipality="Naujan">Motoderazo</option>
        <option value="Mulawin" {{ request('bar_angay') == 'Mulawin' ? 'selected' : '' }} data-municipality="Naujan">Mulawin</option>
        <option value="Nag-iba I" {{ request('bar_angay') == 'Nag-iba I' ? 'selected' : '' }} data-municipality="Naujan">Nag-iba I</option>
        <option value="Nag-iba II" {{ request('bar_angay') == 'Nag-iba II' ? 'selected' : '' }} data-municipality="Naujan">Nag-iba II</option>
        <option value="Pagkakaisa" {{ request('bar_angay') == 'Pagkakaisa' ? 'selected' : '' }} data-municipality="Naujan">Pagkakaisa</option>
        <option value="Paitan" {{ request('bar_angay') == 'Paitan' ? 'selected' : '' }} data-municipality="Naujan">Paitan</option>
        <option value="Paniquian" {{ request('bar_angay') == 'Paniquian' ? 'selected' : '' }} data-municipality="Naujan">Paniquian</option>
        <option value="Pinagsabangan I" {{ request('bar_angay') == 'Pinagsabangan I' ? 'selected' : '' }} data-municipality="Naujan">Pinagsabangan I</option>
        <option value="Pinagsabangan II" {{ request('bar_angay') == 'Pinagsabangan II' ? 'selected' : '' }} data-municipality="Naujan">Pinagsabangan II</option>
        <option value="Piñahan" {{ request('bar_angay') == 'Piñahan' ? 'selected' : '' }} data-municipality="Naujan">Piñahan</option>
        <option value="Poblacion I" {{ request('bar_angay') == 'Poblacion I' ? 'selected' : '' }} data-municipality="Naujan">Poblacion I</option>
        <option value="Poblacion II" {{ request('bar_angay') == 'Poblacion II' ? 'selected' : '' }} data-municipality="Naujan">Poblacion II</option>
        <option value="Poblacion III" {{ request('bar_angay') == 'Poblacion III' ? 'selected' : '' }} data-municipality="Naujan">Poblacion III</option>
        <option value="Sampaguita" {{ request('bar_angay') == 'Sampaguita' ? 'selected' : '' }} data-municipality="Naujan">Sampaguita</option>
        <option value="San Agustin I" {{ request('bar_angay') == 'San Agustin I' ? 'selected' : '' }} data-municipality="Naujan">San Agustin I</option>
        <option value="San Agustin II" {{ request('bar_angay') == 'San Agustin II' ? 'selected' : '' }} data-municipality="Naujan">San Agustin II</option>
        <option value="San Andres" {{ request('bar_angay') == 'San Andres' ? 'selected' : '' }} data-municipality="Naujan">San Andres</option>
        <option value="San Antonio" {{ request('bar_angay') == 'San Antonio' ? 'selected' : '' }} data-municipality="Naujan">San Antonio</option>
        <option value="San Carlos" {{ request('bar_angay') == 'San Carlos' ? 'selected' : '' }} data-municipality="Naujan">San Carlos</option>
        <option value="San Isidro" {{ request('bar_angay') == 'San Isidro' ? 'selected' : '' }} data-municipality="Naujan">San Isidro</option>
        <option value="San Jose" {{ request('bar_angay') == 'San Jose' ? 'selected' : '' }} data-municipality="Naujan">San Jose</option>
        <option value="San Luis" {{ request('bar_angay') == 'San Luis' ? 'selected' : '' }} data-municipality="Naujan">San Luis</option>
        <option value="San Nicolas" {{ request('bar_angay') == 'San Nicolas' ? 'selected' : '' }} data-municipality="Naujan">San Nicolas</option>
        <option value="San Pedro" {{ request('bar_angay') == 'San Pedro' ? 'selected' : '' }} data-municipality="Naujan">San Pedro</option>
        <option value="Santa Cruz" {{ request('bar_angay') == 'Santa Cruz' ? 'selected' : '' }} data-municipality="Naujan">Santa Cruz</option>
        <option value="Santa Isabel" {{ request('bar_angay') == 'Santa Isabel' ? 'selected' : '' }} data-municipality="Naujan">Santa Isabel</option>
        <option value="Santa Maria" {{ request('bar_angay') == 'Santa Maria' ? 'selected' : '' }} data-municipality="Naujan">Santa Maria</option>
        <option value="Santiago" {{ request('bar_angay') == 'Santiago' ? 'selected' : '' }} data-municipality="Naujan">Santiago</option>
        <option value="Santo Niño" {{ request('bar_angay') == 'Santo Niño' ? 'selected' : '' }} data-municipality="Naujan">Santo Niño</option>
        <option value="Tagumpay" {{ request('bar_angay') == 'Tagumpay' ? 'selected' : '' }} data-municipality="Naujan">Tagumpay</option>
        <option value="Tigkan" {{ request('bar_angay') == 'Tigkan' ? 'selected' : '' }} data-municipality="Naujan">Tigkan</option>
    </optgroup>

    <optgroup id="barangay-pinamalayan" style="display: none;">
        <option value="Anoling" {{ request('bar_angay') == 'Anoling' ? 'selected' : '' }} data-municipality="Pinamalayan">Anoling</option>
        <option value="Bacungan" {{ request('bar_angay') == 'Bacungan' ? 'selected' : '' }} data-municipality="Pinamalayan">Bacungan</option>
        <option value="Bangbang" {{ request('bar_angay') == 'Bangbang' ? 'selected' : '' }} data-municipality="Pinamalayan">Bangbang</option>
        <option value="Banilad" {{ request('bar_angay') == 'Banilad' ? 'selected' : '' }} data-municipality="Pinamalayan">Banilad</option>
        <option value="Buli" {{ request('bar_angay') == 'Buli' ? 'selected' : '' }} data-municipality="Pinamalayan">Buli</option>
        <option value="Cacawan" {{ request('bar_angay') == 'Cacawan' ? 'selected' : '' }} data-municipality="Pinamalayan">Cacawan</option>
        <option value="Calingag" {{ request('bar_angay') == 'Calingag' ? 'selected' : '' }} data-municipality="Pinamalayan">Calingag</option>
        <option value="Del Razon" {{ request('bar_angay') == 'Del Razon' ? 'selected' : '' }} data-municipality="Pinamalayan">Del Razon</option>
        <option value="Guinhawa" {{ request('bar_angay') == 'Guinhawa' ? 'selected' : '' }} data-municipality="Pinamalayan">Guinhawa</option>
        <option value="Inclanay" {{ request('bar_angay') == 'Inclanay' ? 'selected' : '' }} data-municipality="Pinamalayan">Inclanay</option>
        <option value="Lumangbayan" {{ request('bar_angay') == 'Lumangbayan' ? 'selected' : '' }} data-municipality="Pinamalayan">Lumangbayan</option>
        <option value="Malaya" {{ request('bar_angay') == 'Malaya' ? 'selected' : '' }} data-municipality="Pinamalayan">Malaya</option>
        <option value="Maliangcog" {{ request('bar_angay') == 'Maliangcog' ? 'selected' : '' }} data-municipality="Pinamalayan">Maliangcog</option>
        <option value="Maningcol" {{ request('bar_angay') == 'Maningcol' ? 'selected' : '' }} data-municipality="Pinamalayan">Maningcol</option>
        <option value="Marayos" {{ request('bar_angay') == 'Marayos' ? 'selected' : '' }} data-municipality="Pinamalayan">Marayos</option>
        <option value="Marfrancisco" {{ request('bar_angay') == 'Marfrancisco' ? 'selected' : '' }} data-municipality="Pinamalayan">Marfrancisco</option>
        <option value="Nabuslot" {{ request('bar_angay') == 'Nabuslot' ? 'selected' : '' }} data-municipality="Pinamalayan">Nabuslot</option>
        <option value="Pagalagala" {{ request('bar_angay') == 'Pagalagala' ? 'selected' : '' }} data-municipality="Pinamalayan">Pagalagala</option>
        <option value="Palayan" {{ request('bar_angay') == 'Palayan' ? 'selected' : '' }} data-municipality="Pinamalayan">Palayan</option>
        <option value="Pambisan Malaki" {{ request('bar_angay') == 'Pambisan Malaki' ? 'selected' : '' }} data-municipality="Pinamalayan">Pambisan Malaki</option>
        <option value="Pambisan Munti" {{ request('bar_angay') == 'Pambisan Munti' ? 'selected' : '' }} data-municipality="Pinamalayan">Pambisan Munti</option>
        <option value="Panggulayan" {{ request('bar_angay') == 'Panggulayan' ? 'selected' : '' }} data-municipality="Pinamalayan">Panggulayan</option>
        <option value="Papandayan" {{ request('bar_angay') == 'Papandayan' ? 'selected' : '' }} data-municipality="Pinamalayan">Papandayan</option>
        <option value="Pili" {{ request('bar_angay') == 'Pili' ? 'selected' : '' }} data-municipality="Pinamalayan">Pili</option>
        <option value="Quinabigan" {{ request('bar_angay') == 'Quinabigan' ? 'selected' : '' }} data-municipality="Pinamalayan">Quinabigan</option>
        <option value="Ranzo" {{ request('bar_angay') == 'Ranzo' ? 'selected' : '' }} data-municipality="Pinamalayan">Ranzo</option>
        <option value="Rosario" {{ request('bar_angay') == 'Rosario' ? 'selected' : '' }} data-municipality="Pinamalayan">Rosario</option>
        <option value="Sabang" {{ request('bar_angay') == 'Sabang' ? 'selected' : '' }} data-municipality="Pinamalayan">Sabang</option>
        <option value="Santa Isabel" {{ request('bar_angay') == 'Santa Isabel' ? 'selected' : '' }} data-municipality="Pinamalayan">Santa Isabel</option>
        <option value="Santa Maria" {{ request('bar_angay') == 'Santa Maria' ? 'selected' : '' }} data-municipality="Pinamalayan">Santa Maria</option>
        <option value="Santa Rita" {{ request('bar_angay') == 'Santa Rita' ? 'selected' : '' }} data-municipality="Pinamalayan">Santa Rita</option>
        <option value="Santo Niño" {{ request('bar_angay') == 'Santo Niño' ? 'selected' : '' }} data-municipality="Pinamalayan">Santo Niño</option>
        <option value="Wawa" {{ request('bar_angay') == 'Wawa' ? 'selected' : '' }} data-municipality="Pinamalayan">Wawa</option>
        <option value="Zone I" {{ request('bar_angay') == 'Zone I' ? 'selected' : '' }} data-municipality="Pinamalayan">Zone I</option>
        <option value="Zone II" {{ request('bar_angay') == 'Zone II' ? 'selected' : '' }} data-municipality="Pinamalayan">Zone II</option>
        <option value="Zone III" {{ request('bar_angay') == 'Zone III' ? 'selected' : '' }} data-municipality="Pinamalayan">Zone III</option>
        <option value="Zone IV" {{ request('bar_angay') == 'Zone IV' ? 'selected' : '' }} data-municipality="Pinamalayan">Zone IV</option>
    </optgroup>


    <optgroup id="barangay-pola" style="display: none;">
        <option value="Bacawan" {{ request('bar_angay') == 'Bacawan' ? 'selected' : '' }} data-municipality="Pola">Bacawan</option>
        <option value="Bacungan" {{ request('bar_angay') == 'Bacungan' ? 'selected' : '' }} data-municipality="Pola">Bacungan</option>
        <option value="Batuhan" {{ request('bar_angay') == 'Batuhan' ? 'selected' : '' }} data-municipality="Pola">Batuhan</option>
        <option value="Bayanan" {{ request('bar_angay') == 'Bayanan' ? 'selected' : '' }} data-municipality="Pola">Bayanan</option>
        <option value="Biga" {{ request('bar_angay') == 'Biga' ? 'selected' : '' }} data-municipality="Pola">Biga</option>
        <option value="Buhay na Tubig" {{ request('bar_angay') == 'Buhay na Tubig' ? 'selected' : '' }} data-municipality="Pola">Buhay na Tubig</option>
        <option value="Calima" {{ request('bar_angay') == 'Calima' ? 'selected' : '' }} data-municipality="Pola">Calima</option>
        <option value="Calubasanhon" {{ request('bar_angay') == 'Calubasanhon' ? 'selected' : '' }} data-municipality="Pola">Calubasanhon</option>
        <option value="Campamento" {{ request('bar_angay') == 'Campamento' ? 'selected' : '' }} data-municipality="Pola">Campamento</option>
        <option value="Casiligan" {{ request('bar_angay') == 'Casiligan' ? 'selected' : '' }} data-municipality="Pola">Casiligan</option>
        <option value="Malibago" {{ request('bar_angay') == 'Malibago' ? 'selected' : '' }} data-municipality="Pola">Malibago</option>
        <option value="Maluanluan" {{ request('bar_angay') == 'Maluanluan' ? 'selected' : '' }} data-municipality="Pola">Maluanluan</option>
        <option value="Matulatula" {{ request('bar_angay') == 'Matulatula' ? 'selected' : '' }} data-municipality="Pola">Matulatula</option>
        <option value="Misong" {{ request('bar_angay') == 'Misong' ? 'selected' : '' }} data-municipality="Pola">Misong</option>
        <option value="Pahilahan" {{ request('bar_angay') == 'Pahilahan' ? 'selected' : '' }} data-municipality="Pola">Pahilahan</option>
        <option value="Panikihan" {{ request('bar_angay') == 'Panikihan' ? 'selected' : '' }} data-municipality="Pola">Panikihan</option>
        <option value="Pula" {{ request('bar_angay') == 'Pula' ? 'selected' : '' }} data-municipality="Pola">Pula</option>
        <option value="Puting Cacao" {{ request('bar_angay') == 'Puting Cacao' ? 'selected' : '' }} data-municipality="Pola">Puting Cacao</option>
        <option value="Tagbakin" {{ request('bar_angay') == 'Tagbakin' ? 'selected' : '' }} data-municipality="Pola">Tagbakin</option>
        <option value="Tagumpay" {{ request('bar_angay') == 'Tagumpay' ? 'selected' : '' }} data-municipality="Pola">Tagumpay</option>
        <option value="Tiguihan" {{ request('bar_angay') == 'Tiguihan' ? 'selected' : '' }} data-municipality="Pola">Tiguihan</option>
        <option value="Zone I" {{ request('bar_angay') == 'Zone I' ? 'selected' : '' }} data-municipality="Pola">Zone I</option>
        <option value="Zone II" {{ request('bar_angay') == 'Zone II' ? 'selected' : '' }} data-municipality="Pola">Zone II</option>
    </optgroup>

    <optgroup id="barangay-puerto galera" style="display: none;">
        <option value="Aninuan" {{ request('bar_angay') == 'Aninuan' ? 'selected' : '' }} data-municipality="Puerto Galera">Aninuan</option>
        <option value="Baclayan" {{ request('bar_angay') == 'Baclayan' ? 'selected' : '' }} data-municipality="Puerto Galera">Baclayan</option>
        <option value="Balatero" {{ request('bar_angay') == 'Balatero' ? 'selected' : '' }} data-municipality="Puerto Galera">Balatero</option>
        <option value="Dulangan" {{ request('bar_angay') == 'Dulangan' ? 'selected' : '' }} data-municipality="Puerto Galera">Dulangan</option>
        <option value="Palangan" {{ request('bar_angay') == 'Palangan' ? 'selected' : '' }} data-municipality="Puerto Galera">Palangan</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="Puerto Galera">Poblacion</option>
        <option value="Sabang" {{ request('bar_angay') == 'Sabang' ? 'selected' : '' }} data-municipality="Puerto Galera">Sabang</option>
        <option value="San Antonio" {{ request('bar_angay') == 'San Antonio' ? 'selected' : '' }} data-municipality="Puerto Galera">San Antonio</option>
        <option value="San Isidro" {{ request('bar_angay') == 'San Isidro' ? 'selected' : '' }} data-municipality="Puerto Galera">San Isidro</option>
        <option value="Santo Niño" {{ request('bar_angay') == 'Santo Niño' ? 'selected' : '' }} data-municipality="Puerto Galera">Santo Niño</option>
        <option value="Sinandigan" {{ request('bar_angay') == 'Sinandigan' ? 'selected' : '' }} data-municipality="Puerto Galera">Sinandigan</option>
        <option value="Tabinay" {{ request('bar_angay') == 'Tabinay' ? 'selected' : '' }} data-municipality="Puerto Galera">Tabinay</option>
        <option value="Villaflor" {{ request('bar_angay') == 'Villaflor' ? 'selected' : '' }} data-municipality="Puerto Galera">Villaflor</option>
    </optgroup>

    <optgroup id="barangay-roxas" style="display: none;">
        <option value="Bagumbayan" {{ request('bar_angay') == 'Bagumbayan' ? 'selected' : '' }} data-municipality="Roxas">Bagumbayan</option>
        <option value="Cantil" {{ request('bar_angay') == 'Cantil' ? 'selected' : '' }} data-municipality="Roxas">Cantil</option>
        <option value="Dangay" {{ request('bar_angay') == 'Dangay' ? 'selected' : '' }} data-municipality="Roxas">Dangay</option>
        <option value="Happy Valley" {{ request('bar_angay') == 'Happy Valley' ? 'selected' : '' }} data-municipality="Roxas">Happy Valley</option>
        <option value="Libertad" {{ request('bar_angay') == 'Libertad' ? 'selected' : '' }} data-municipality="Roxas">Libertad</option>
        <option value="Libtong" {{ request('bar_angay') == 'Libtong' ? 'selected' : '' }} data-municipality="Roxas">Libtong</option>
        <option value="Little Tanauan" {{ request('bar_angay') == 'Little Tanauan' ? 'selected' : '' }} data-municipality="Roxas">Little Tanauan</option>
        <option value="Mabuhay" {{ request('bar_angay') == 'Mabuhay' ? 'selected' : '' }} data-municipality="Roxas">Mabuhay</option>
        <option value="Maraska" {{ request('bar_angay') == 'Maraska' ? 'selected' : '' }} data-municipality="Roxas">Maraska</option>
        <option value="Odiong" {{ request('bar_angay') == 'Odiong' ? 'selected' : '' }} data-municipality="Roxas">Odiong</option>
        <option value="Paclasan" {{ request('bar_angay') == 'Paclasan' ? 'selected' : '' }} data-municipality="Roxas">Paclasan</option>
        <option value="San Aquilino" {{ request('bar_angay') == 'San Aquilino' ? 'selected' : '' }} data-municipality="Roxas">San Aquilino</option>
        <option value="San Isidro" {{ request('bar_angay') == 'San Isidro' ? 'selected' : '' }} data-municipality="Roxas">San Isidro</option>
        <option value="San Jose" {{ request('bar_angay') == 'San Jose' ? 'selected' : '' }} data-municipality="Roxas">San Jose</option>
        <option value="San Mariano" {{ request('bar_angay') == 'San Mariano' ? 'selected' : '' }} data-municipality="Roxas">San Mariano</option>
        <option value="San Miguel" {{ request('bar_angay') == 'San Miguel' ? 'selected' : '' }} data-municipality="Roxas">San Miguel</option>
        <option value="San Rafael" {{ request('bar_angay') == 'San Rafael' ? 'selected' : '' }} data-municipality="Roxas">San Rafael</option>
        <option value="San Vicente" {{ request('bar_angay') == 'San Vicente' ? 'selected' : '' }} data-municipality="Roxas">San Vicente</option>
        <option value="Talon" {{ request('bar_angay') == 'Talon' ? 'selected' : '' }} data-municipality="Roxas">Talon</option>
        <option value="Victoria" {{ request('bar_angay') == 'Victoria' ? 'selected' : '' }} data-municipality="Roxas">Victoria</option>
    </optgroup>

    <optgroup id="barangay-san teodoro" style="display: none;">
        <option value="Bigaan" {{ request('bar_angay') == 'Bigaan' ? 'selected' : '' }} data-municipality="San Teodoro">Bigaan</option>
        <option value="Calangatan" {{ request('bar_angay') == 'Calangatan' ? 'selected' : '' }} data-municipality="San Teodoro">Calangatan</option>
        <option value="Caulaman" {{ request('bar_angay') == 'Caulaman' ? 'selected' : '' }} data-municipality="San Teodoro">Caulaman</option>
        <option value="Caurusan" {{ request('bar_angay') == 'Caurusan' ? 'selected' : '' }} data-municipality="San Teodoro">Caurusan</option>
        <option value="Calsapa" {{ request('bar_angay') == 'Calsapa' ? 'selected' : '' }} data-municipality="San Teodoro">Calsapa</option>
        <option value="El Progreso" {{ request('bar_angay') == 'El Progreso' ? 'selected' : '' }} data-municipality="San Teodoro">El Progreso</option>
        <option value="Lumang Bayan" {{ request('bar_angay') == 'Lumang Bayan' ? 'selected' : '' }} data-municipality="San Teodoro">Lumang Bayan</option>
        <option value="Malajon" {{ request('bar_angay') == 'Malajon' ? 'selected' : '' }} data-municipality="San Teodoro">Malajon</option>
        <option value="Pacifico" {{ request('bar_angay') == 'Pacifico' ? 'selected' : '' }} data-municipality="San Teodoro">Pacifico</option>
        <option value="Poblacion" {{ request('bar_angay') == 'Poblacion' ? 'selected' : '' }} data-municipality="San Teodoro">Poblacion</option>
        <option value="Tacligan" {{ request('bar_angay') == 'Tacligan' ? 'selected' : '' }} data-municipality="San Teodoro">Tacligan</option>
        <option value="Tibag" {{ request('bar_angay') == 'Tibag' ? 'selected' : '' }} data-municipality="San Teodoro">Tibag</option>
    </optgroup>

    <optgroup id="barangay-socorro" style="display: none;">
        <option value="Bagsok" {{ request('bar_angay') == 'Bagsok' ? 'selected' : '' }} data-municipality="Socorro">Bagsok</option>
        <option value="Batong Dalig" {{ request('bar_angay') == 'Batong Dalig' ? 'selected' : '' }} data-municipality="Socorro">Batong Dalig</option>
        <option value="Bayuin" {{ request('bar_angay') == 'Bayuin' ? 'selected' : '' }} data-municipality="Socorro">Bayuin</option>
        <option value="Bugtong na Tuog" {{ request('bar_angay') == 'Bugtong na Tuog' ? 'selected' : '' }} data-municipality="Socorro">Bugtong na Tuog</option>
        <option value="Calocmoy" {{ request('bar_angay') == 'Calocmoy' ? 'selected' : '' }} data-municipality="Socorro">Calocmoy</option>
        <option value="Calubayan" {{ request('bar_angay') == 'Calubayan' ? 'selected' : '' }} data-municipality="Socorro">Calubayan</option>
        <option value="Catiningan" {{ request('bar_angay') == 'Catiningan' ? 'selected' : '' }} data-municipality="Socorro">Catiningan</option>
        <option value="Fortuna" {{ request('bar_angay') == 'Fortuna' ? 'selected' : '' }} data-municipality="Socorro">Fortuna</option>
        <option value="Happy Valley" {{ request('bar_angay') == 'Happy Valley' ? 'selected' : '' }} data-municipality="Socorro">Happy Valley</option>
        <option value="Leuteboro I" {{ request('bar_angay') == 'Leuteboro I' ? 'selected' : '' }} data-municipality="Socorro">Leuteboro I</option>
        <option value="Leuteboro II" {{ request('bar_angay') == 'Leuteboro II' ? 'selected' : '' }} data-municipality="Socorro">Leuteboro II</option>
        <option value="Ma. Concepcion" {{ request('bar_angay') == 'Ma. Concepcion' ? 'selected' : '' }} data-municipality="Socorro">Ma. Concepcion</option>
        <option value="Mabuhay I" {{ request('bar_angay') == 'Mabuhay I' ? 'selected' : '' }} data-municipality="Socorro">Mabuhay I</option>
        <option value="Mabuhay II" {{ request('bar_angay') == 'Mabuhay II' ? 'selected' : '' }} data-municipality="Socorro">Mabuhay II</option>
        <option value="Malugay" {{ request('bar_angay') == 'Malugay' ? 'selected' : '' }} data-municipality="Socorro">Malugay</option>
        <option value="Matungao" {{ request('bar_angay') == 'Matungao' ? 'selected' : '' }} data-municipality="Socorro">Matungao</option>
        <option value="Monteverde" {{ request('bar_angay') == 'Monteverde' ? 'selected' : '' }} data-municipality="Socorro">Monteverde</option>
        <option value="Pasi I" {{ request('bar_angay') == 'Pasi I' ? 'selected' : '' }} data-municipality="Socorro">Pasi I</option>
        <option value="Pasi II" {{ request('bar_angay') == 'Pasi II' ? 'selected' : '' }} data-municipality="Socorro">Pasi II</option>
        <option value="Santo Domingo" {{ request('bar_angay') == 'Santo Domingo' ? 'selected' : '' }} data-municipality="Socorro">Santo Domingo</option>
        <option value="Subaan" {{ request('bar_angay') == 'Subaan' ? 'selected' : '' }} data-municipality="Socorro">Subaan</option>
        <option value="Villareal" {{ request('bar_angay') == 'Villareal' ? 'selected' : '' }} data-municipality="Socorro">Villareal</option>
        <option value="Zone I" {{ request('bar_angay') == 'Zone I' ? 'selected' : '' }} data-municipality="Socorro">Zone I</option>
        <option value="Zone II" {{ request('bar_angay') == 'Zone II' ? 'selected' : '' }} data-municipality="Socorro">Zone II</option>
        <option value="Zone III" {{ request('bar_angay') == 'Zone III' ? 'selected' : '' }} data-municipality="Socorro">Zone III</option>
        <option value="Zone IV" {{ request('bar_angay') == 'Zone IV' ? 'selected' : '' }} data-municipality="Socorro">Zone IV</option>
    </optgroup>

    <optgroup id="barangay-victoria" style="display: none;">
        <option value="Alcate" {{ request('bar_angay') == 'Alcate' ? 'selected' : '' }} data-municipality="Victoria">Alcate</option>
        <option value="Antonino" {{ request('bar_angay') == 'Antonino' ? 'selected' : '' }} data-municipality="Victoria">Antonino</option>
        <option value="Babangonan" {{ request('bar_angay') == 'Babangonan' ? 'selected' : '' }} data-municipality="Victoria">Babangonan</option>
        <option value="Bagong Buhay" {{ request('bar_angay') == 'Bagong Buhay' ? 'selected' : '' }} data-municipality="Victoria">Bagong Buhay</option>
        <option value="Bagong Silang" {{ request('bar_angay') == 'Bagong Silang' ? 'selected' : '' }} data-municipality="Victoria">Bagong Silang</option>
        <option value="Bambanin" {{ request('bar_angay') == 'Bambanin' ? 'selected' : '' }} data-municipality="Victoria">Bambanin</option>
        <option value="Bethel" {{ request('bar_angay') == 'Bethel' ? 'selected' : '' }} data-municipality="Victoria">Bethel</option>
        <option value="Canaan" {{ request('bar_angay') == 'Canaan' ? 'selected' : '' }} data-municipality="Victoria">Canaan</option>
        <option value="Concepcion" {{ request('bar_angay') == 'Concepcion' ? 'selected' : '' }} data-municipality="Victoria">Concepcion</option>
        <option value="Duongan" {{ request('bar_angay') == 'Duongan' ? 'selected' : '' }} data-municipality="Victoria">Duongan</option>
        <option value="Jose Leido Jr." {{ request('bar_angay') == 'Jose Leido Jr.' ? 'selected' : '' }} data-municipality="Victoria">Jose Leido Jr.</option>
        <option value="Loyal" {{ request('bar_angay') == 'Loyal' ? 'selected' : '' }} data-municipality="Victoria">Loyal</option>
        <option value="Mabini" {{ request('bar_angay') == 'Mabini' ? 'selected' : '' }} data-municipality="Victoria">Mabini</option>
        <option value="Macatoc" {{ request('bar_angay') == 'Macatoc' ? 'selected' : '' }} data-municipality="Victoria">Macatoc</option>
        <option value="Malabo" {{ request('bar_angay') == 'Malabo' ? 'selected' : '' }} data-municipality="Victoria">Malabo</option>
        <option value="Merit" {{ request('bar_angay') == 'Merit' ? 'selected' : '' }} data-municipality="Victoria">Merit</option>
        <option value="Ordovilla" {{ request('bar_angay') == 'Ordovilla' ? 'selected' : '' }} data-municipality="Victoria">Ordovilla</option>
        <option value="Pakyas" {{ request('bar_angay') == 'Pakyas' ? 'selected' : '' }} data-municipality="Victoria">Pakyas</option>
        <option value="Poblacion I" {{ request('bar_angay') == 'Poblacion I' ? 'selected' : '' }} data-municipality="Victoria">Poblacion I</option>
        <option value="Poblacion II" {{ request('bar_angay') == 'Poblacion II' ? 'selected' : '' }} data-municipality="Victoria">Poblacion II</option>
        <option value="Poblacion III" {{ request('bar_angay') == 'Poblacion III' ? 'selected' : '' }} data-municipality="Victoria">Poblacion III</option>
        <option value="Poblacion IV" {{ request('bar_angay') == 'Poblacion IV' ? 'selected' : '' }} data-municipality="Victoria">Poblacion IV</option>
        <option value="Sampaguita" {{ request('bar_angay') == 'Sampaguita' ? 'selected' : '' }} data-municipality="Victoria">Sampaguita</option>
        <option value="San Antonio" {{ request('bar_angay') == 'San Antonio' ? 'selected' : '' }} data-municipality="Victoria">San Antonio</option>
        <option value="San Cristobal" {{ request('bar_angay') == 'San Cristobal' ? 'selected' : '' }} data-municipality="Victoria">San Cristobal</option>
        <option value="San Gabriel" {{ request('bar_angay') == 'San Gabriel' ? 'selected' : '' }} data-municipality="Victoria">San Gabriel</option>
        <option value="San Gelacio" {{ request('bar_angay') == 'San Gelacio' ? 'selected' : '' }} data-municipality="Victoria">San Gelacio</option>
        <option value="San Isidro" {{ request('bar_angay') == 'San Isidro' ? 'selected' : '' }} data-municipality="Victoria">San Isidro</option>
        <option value="San Juan" {{ request('bar_angay') == 'San Juan' ? 'selected' : '' }} data-municipality="Victoria">San Juan</option>
        <option value="San Narciso" {{ request('bar_angay') == 'San Narciso' ? 'selected' : '' }} data-municipality="Victoria">San Narciso</option>
        <option value="Urdaneta" {{ request('bar_angay') == 'Urdaneta' ? 'selected' : '' }} data-municipality="Victoria">Urdaneta</option>
        <option value="Villa Cerveza" {{ request('bar_angay') == 'Villa Cerveza' ? 'selected' : '' }} data-municipality="Victoria">Villa Cerveza</option>
    </optgroup>
                            