<?php

// Check that the session
require_once ("includes/action-create.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Letter Details</h2>
                    <p>Please fill this form and submit to add Letter records.</p>
                    <form action="includes/action-create.php" method="post"  enctype="multipart/form-data">
                      
                        <div class="form-group">
                            <label>Reference number(Our Reference)</label>
                            <input type="text" required="required" name="name"  class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>

                          <div class="form-group">
                            <label>Received number(Your Reference)</label>
                            <input type="text"  name="name1"  class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>



                        <div class="form-group">
                            <label for="validationServer04">How received</label>
                            <select name="How_received">
                                <option value="None">None</option>
                                <option value="Letter">Letter</option>
                                <option value="Fax">Fax</option>
                                <option value="Petition">Petition</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Referred_Division">Received / Referred Division</label>
                            <select name="Referred_Division">
                                <option value="None">Select Division or Police Station</option>
                                <Option>    Achchuveli  </Option>
<Option>    Agalawatta  </Option>
<Option>    Agarapathana    </Option>
<Option>    Agbopura    </Option>
<Option>    Ahangama    </Option>
<Option>    Ahungalla   </Option>
<Option>    Air Port    </Option>
<Option>    Aithimalaya </Option>
<Option>    Akkaraipattu    </Option>
<Option>    Akkarayankulama </Option>
<Option>    Akmeemana   </Option>
<Option>    Akuressa    </Option>
<Option>    Alawathugoda    </Option>
<Option>    Alawwa  </Option>
<Option>    Aluthgama   </Option>
<Option>    Ambagasdoowa    </Option>
<Option>    Ambalangoda </Option>
<Option>    Ambalantota </Option>
<Option>    Ambanpola   </Option>
<Option>    Ampara  </Option>
<Option>    Anamaduwa   </Option>
<Option>    Angulana    </Option>
<Option>    Angunakolapelessa   </Option>
<Option>    Anguruwatota    </Option>
<Option>    Ankumbura   </Option>
<Option>    Antiquities Protection Division </Option>
<Option>    Anuradhapura    </Option>
<Option>    ASP D&C Office  </Option>
<Option>    Arachchikattuwa </Option>
<Option>    Aralaganwila    </Option>
<Option>    Aranayake   </Option>
<Option>    Athurugiriya    </Option>
<Option>    Avissawella </Option>
<Option>    Ayagama </Option>
<Option>    B.M.I.C.H.  </Option>
<Option>    Badalkumbura    </Option>
<Option>    Baddegama   </Option>
<Option>    Badulla </Option>
<Option>    Baduraliya  </Option>
<Option>    Bakamuna    </Option>
<Option>    Bakkiella   </Option>
<Option>    Balangoda   </Option>
<Option>    Bambalapitiya   </Option>
<Option>    Bandaragama </Option>
<Option>    Bandarawela </Option>
<Option>    Batapola    </Option>
<Option>    Batticaloa  </Option>
<Option>    Beliatta    </Option>
<Option>    Bemmulla    </Option>
<Option>    Bentota </Option>
<Option>    Beruwala    </Option>
<Option>    Bibila  </Option>
<Option>    Bingiriya   </Option>
<Option>    Biyagama    </Option>
<Option>    Bluemendhal </Option>
<Option>    Bogahakumbura   </Option>
<Option>    Bogaswewa   </Option>
<Option>    Bogawantalawa   </Option>
<Option>    Boralesgamuwa   </Option>
<Option>    Borella </Option>
<Option>    Bribery Division    </Option>
<Option>    Buildings Division  </Option>
<Option>    Bulathkohupitiya    </Option>
<Option>    Bulathsinhala   </Option>
<Option>    Buttala </Option>
<Option>    Central Anti Vice Striking Force    </Option>
<Option>    Central Camp    </Option>
<Option>    Central Province    </Option>
<Option>    Chawakachcheri  </Option>
<Option>    Chawalakade </Option>
<Option>    Cheddikulam </Option>
<Option>    Chilaw  </Option>
<Option>    Children  &  Women Bureau   </Option>
<Option>    China Bay   </Option>
<Option>    Chunnakam   </Option>
<Option>    Cinamon Garden  </Option>
<Option>    Civil Security Department   </Option>
<Option>    Close Circuit Television    </Option>
<Option>    Colombo Central </Option>
<Option>    Colombo City Traffic    </Option>
<Option>    Colombo Crimes Division </Option>
<Option>    Colombo Fraud Investigation Bureau  </Option>
<Option>    Colombo North   </Option>
<Option>    Colombo South   </Option>
<Option>    Communication   </Option>
<Option>    Community Policing  </Option>
<Option>    Crime Detective Bureau  </Option>
<Option>    Crimes Division </Option>
<Option>    Criminal Investigation Department   </Option>
<Option>    Criminal Record Division    </Option>
<Option>    Dahrmapuram </Option>
<Option>    Daladamaligawa  </Option>
<Option>    Dam Street  </Option>
<Option>    Damana  </Option>
<Option>    Dambagalla  </Option>
<Option>    Dambulla    </Option>
<Option>    Dankotuwa   </Option>
<Option>    Daulagala   </Option>
<Option>    Dayagama    </Option>
<Option>    Dedigama    </Option>
<Option>    Dehiattakandiya </Option>
<Option>    Dehiwela    </Option>
<Option>    Deiyandara  </Option>
<Option>    Delft   </Option>
<Option>    Dematagoda  </Option>
<Option>    Deniyaya    </Option>
<Option>    Deplometic Security Division    </Option>
<Option>    Deraniyagala    </Option>
<Option>    Dikwella    </Option>
<Option>    Dimbula </Option>
<Option>    Discipline & Conduct    </Option>
<Option>    Divulapitiya    </Option>
<Option>    Diyatalawa  </Option>
<Option>    Director D&C Office</Option>
<Option>    DIG D&C Office </Option>
<Option>    Diyatalawa  </Option>
<Option>    Dodangoda   </Option>
<Option>    Dompe   </Option>
<Option>    Dummalasuriya   </Option>
<Option>    Dungalpitiya    </Option>
<Option>    Eastern Province    </Option>
<Option>    Echchcankulama  </Option>
<Option>    Egodauyana  </Option>
<Option>    Eheliyagoda </Option>
<Option>    Election Division   </Option>
<Option>    Ella    </Option>
<Option>    Elpitiya    </Option>
<Option>    Elpitiya Division   </Option>
<Option>    Embilipitiya    </Option>
<Option>    Emergency   </Option>
<Option>    Environment Protection  </Option>
<Option>    Eppawala    </Option>
<Option>    Eravur  </Option>
<Option>    Etampitiya  </Option>
<Option>    Ethimale    </Option>
<Option>    Ex. Presidential Security Division I    </Option>
<Option>    Ex. Presidential Security Division Il   </Option>
<Option>    Ex. Presidential Security Division Ill  </Option>
<Option>    Ex. Presidential Security Division IV   </Option>
<Option>    Ex. Presidential Security Division V    </Option>
<Option>    Ex. Presidential Security Division Vi   </Option>
<Option>    Exam Divison    </Option>
<Option>    Express Highway </Option>
<Option>    Field Force Headquarters    </Option>
<Option>    Financial Crimes Investigation  </Option>
<Option>    Foreshore   </Option>
<Option>    Fort    </Option>
<Option>    Galagedara  </Option>
<Option>    Galaha  </Option>
<Option>    Galenbindunuwewa    </Option>
<Option>    Galewela    </Option>
<Option>    Galgamuwa   </Option>
<Option>    Galkiriyagama   </Option>
<Option>    Galle   </Option>
<Option>    Galle Division  </Option>
<Option>    Galle Harbour   </Option>
<Option>    Galnewa </Option>
<Option>    Gampaha </Option>
<Option>    Gampaha Division    </Option>
<Option>    Gampola </Option>
<Option>    Gampola Division    </Option>
<Option>    Gandara </Option>
<Option>    Ganemulla   </Option>
<Option>    Ginigathhena    </Option>
<Option>    Girandurukotta  </Option>
<Option>    Giribawa    </Option>
<Option>    Giriulla    </Option>
<Option>    Godakawela  </Option>
<Option>    Gokarella   </Option>
<Option>    Gomarankadawala </Option>
<Option>    Gonaganara  </Option>
<Option>    Gothatuwa   </Option>
<Option>    Govindupura </Option>
<Option>    Grandpass   </Option>
<Option>    Habaraduwa  </Option>
<Option>    Habarana    </Option>
<Option>    Hakmana </Option>
<Option>    Haldummulla </Option>
<Option>    Haliella    </Option>
<Option>    Hambantota  </Option>
<Option>    Hambegamuwa </Option>
<Option>    Hanguranketha   </Option>
<Option>    Hanwella    </Option>
<Option>    Haputale    </Option>
<Option>    Harbour </Option>
<Option>    Hasalaka    </Option>
<Option>    Hataraliyadda   </Option>
<Option>    Hatton  </Option>
<Option>    Hatton Division </Option>
<Option>    Hemmathagama    </Option>
<Option>    Hettipola   </Option>
<Option>    Hidogama    </Option>
<Option>    Hikkaduwa   </Option>
<Option>    Hingurakgoda    </Option>
<Option>    Hiniduma    </Option>
<Option>    Homagama    </Option>
<Option>    Horana  </Option>
<Option>    Horowpathana    </Option>
<Option>    Human Resource Management Division  </Option>
<Option>    Human Rights    </Option>
<Option>    Hungama </Option>
<Option>    IGs Command & Information   </Option>
<Option>    Illavali    </Option>
<Option>    Illuppakadawai  </Option>
<Option>    Imaduwa </Option>
<Option>    Information Technology Division </Option>
<Option>    Inginiyagala    </Option>
<Option>    Ingiriya    </Option>
<Option>    Inservice Anuradhapura  </Option>
<Option>    Inservice Neeththa  </Option>
<Option>    Inspection & Reaview    </Option>
<Option>    Ipalogama   </Option>
<Option>    Irattaperiyakulam   </Option>
<Option>    Ja-Ela  </Option>
<Option>    Jaffna  </Option>
<Option>    Jaffna Division </Option>
<Option>    Jayapuram   </Option>
<Option>    Judicial Security Division  </Option>
<Option>    K.K.S.  </Option>
<Option>    Kadawatha   </Option>
<Option>    Kadugannawa </Option>
<Option>    Kahatagasdigiliya   </Option>
<Option>    Kahatuduwa  </Option>
<Option>    Kahawatte   </Option>
<Option>    Kalawana    </Option>
<Option>    Kalawanchikudy  </Option>
<Option>    Kalkudha    </Option>
<Option>    Kalmunai    </Option>
<Option>    Kalpitiya   </Option>
<Option>    Kaltota </Option>
<Option>    Kalutara    </Option>
<Option>    Kalutara Division   </Option>
<Option>    Kalutara North  </Option>
<Option>    Kalutara South  </Option>
<Option>    Kamburupitiya   </Option>
<Option>    Kanagarayankulam    </Option>
<Option>    Kananke </Option>
<Option>    Kandaketiya </Option>
<Option>    Kandana </Option>
<Option>    Kandapola   </Option>
<Option>    Kandy   </Option>
<Option>    Kandy Division  </Option>
<Option>    Kantale </Option>
<Option>    Kantale Division    </Option>
<Option>    Karadiyanaru    </Option>
<Option>    Karandeniya </Option>
<Option>    Karandugala </Option>
<Option>    Karuwalagaswewa </Option>
<Option>    Katana  </Option>
<Option>    Kataragama  </Option>
<Option>    Kathankudy  </Option>
<Option>    Katugastota </Option>
<Option>    Katunayaka  </Option>
<Option>    Katupotha   </Option>
<Option>    Katuwana    </Option>
<Option>    Kayts   </Option>
<Option>    Kebithigollewa  </Option>
<Option>    Kegalle </Option>
<Option>    Kegalle Division    </Option>
<Option>    Kekirawa    </Option>
<Option>    Kelanithissa Power Station  </Option>
<Option>    Kelaniya    </Option>
<Option>    Kelaniya Division   </Option>
<Option>    Kennels </Option>
<Option>    Keragala    </Option>
<Option>    Keselwatta  </Option>
<Option>    Kilinochchi </Option>
<Option>    Kilinochchi Division    </Option>
<Option>    Kinniya </Option>
<Option>    Kiribathgoda    </Option>
<Option>    Kiriella    </Option>
<Option>    Kirinda </Option>
<Option>    Kirindiwela </Option>
<Option>    Kirulapone  </Option>
<Option>    Kithulgala  </Option>
<Option>    KKS Division    </Option>
<Option>    Kobeigane   </Option>
<Option>    Kochchikade </Option>
<Option>    Kodikamam   </Option>
<Option>    Kohuwala    </Option>
<Option>    Kokkadicholai   </Option>
<Option>    Kollupitiya </Option>
<Option>    Kolonna </Option>
<Option>    Kopai   </Option>
<Option>    Kosgama </Option>
<Option>    Kosgoda </Option>
<Option>    Koslanda    </Option>
<Option>    Kosmodara   </Option>
<Option>    Koswatte    </Option>
<Option>    Kotadeniyawa    </Option>
<Option>    Kotagala    </Option>
<Option>    Kotahena    </Option>
<Option>    Kotavila    </Option>
<Option>    Kotawehera  </Option>
<Option>    Kothmale    </Option>
<Option>    Kottawa </Option>
<Option>    Kuchchaveli </Option>
<Option>    Kudaoya </Option>
<Option>    Kuliyapitiya    </Option>
<Option>    Kuliyapitiya Division   </Option>
<Option>    Kumbukgete  </Option>
<Option>    Kurunegala  </Option>
<Option>    Kurunegala Division </Option>
<Option>    Kuruwita    </Option>
<Option>    Kuttigala   </Option>
<Option>    Laggala </Option>
<Option>    Legal Division  </Option>
<Option>    Lindula </Option>
<Option>    Lunugala    </Option>
<Option>    Lunugamwehera   </Option>
<Option>    Madampe </Option>
<Option>    Madolsima   </Option>
<Option>    Madu    </Option>
<Option>    Madukanda   </Option>
<Option>    Maha Oya    </Option>
<Option>    Mahabage    </Option>
<Option>    Mahakalugolla   </Option>
<Option>    Maharagama  </Option>
<Option>    Mahavilachchiya </Option>
<Option>    Mahawela    </Option>
<Option>    Mahiyanganaya   </Option>
<Option>    Maho    </Option>
<Option>    Maligawatta </Option>
<Option>    Malimbada   </Option>
<Option>    Mallavi </Option>
<Option>    Malwathu Hiripitiya </Option>
<Option>    Mamaduwa    </Option>
<Option>    Management & Development    </Option>
<Option>    Mandaramnuwara  </Option>
<Option>    Mangalagama </Option>
<Option>    Manipay </Option>
<Option>    Mankulam    </Option>
<Option>    Mannar  </Option>
<Option>    Mannar Division </Option>
<Option>    Maradana    </Option>
<Option>    Marawila    </Option>
<Option>    Marine Division </Option>
<Option>    Maskeliya   </Option>
<Option>    Matale  </Option>
<Option>    Matale Division </Option>
<Option>    Matara  </Option>
<Option>    Matara Division </Option>
<Option>    Mathurata   </Option>
<Option>    Mattakkuliya    </Option>
<Option>    Mattegoda   </Option>
<Option>    Matugama    </Option>
<Option>    Mawanella   </Option>
<Option>    Mawarala    </Option>
<Option>    Mawathagama </Option>
<Option>    Medagama    </Option>
<Option>    Medawachchiya   </Option>
<Option>    Medirigiriya    </Option>
<Option>    Meegahathenna   </Option>
<Option>    Meegahawatta    </Option>
<Option>    Meegalewa   </Option>
<Option>    Meepe   </Option>
<Option>    Meetiyagoda </Option>
<Option>    Menikhinna  </Option>
<Option>    Middeniya   </Option>
<Option>    Mihintale   </Option>
<Option>    Millaniya   </Option>
<Option>    Ministers Security Division </Option>
<Option>    Ministry Co-Ordinating Division </Option>
<Option>    Minneriya   </Option>
<Option>    Minuwangoda </Option>
<Option>    Mirigama    </Option>
<Option>    Mirihana    </Option>
<Option>    Mirihana Crime Division </Option>
<Option>    Modara  </Option>
<Option>    Monaragala  </Option>
<Option>    Monaragala Division </Option>
<Option>    Moragahahena    </Option>
<Option>    Moragoda    </Option>
<Option>    Moratumulla </Option>
<Option>    Moratuwa    </Option>
<Option>    Morawaka    </Option>
<Option>    Morawewa    </Option>
<Option>    Moronthuduwa    </Option>
<Option>    Mounted Division    </Option>
<Option>    Mt. Lavinia </Option>
<Option>    MTC Akuramboda  </Option>
<Option>    MTC Dewahoowa   </Option>
<Option>    MTC Madampe </Option>
<Option>    MTC Madampe </Option>
<Option>    MTC Mahiyangana </Option>
<Option>    MTC Pahalagama  </Option>
<Option>    MTC Uva Kuda Oya    </Option>
<Option>    Mulalliyaweli   </Option>
<Option>    Mulankavil  </Option>
<Option>    Mulathivu   </Option>
<Option>    Mulathivu Division  </Option>
<Option>    Mulleriyawa </Option>
<Option>    Mundal  </Option>
<Option>    Murunkan    </Option>
<Option>    Muttur  </Option>
<Option>    Nachchikuda </Option>
<Option>    Nagoda  </Option>
<Option>    Nallathanniya   </Option>
<Option>    Nanu-Oya    </Option>
<Option>    Narahenpita </Option>
<Option>    Narammala   </Option>
<Option>    Narcotics Bureau    </Option>
<Option>    National Police Academy </Option>
<Option>    National Police Academy - Inservice </Option>
<Option>    Naula   </Option>
<Option>    Nawa Kurunduwatta   </Option>
<Option>    Nawagamuwa  </Option>
<Option>    Nawagattegama   </Option>
<Option>    Nawalapitiya    </Option>
<Option>    Nedumkerni  </Option>
<Option>    Negombo </Option>
<Option>    Negombo Division    </Option>
<Option>    Nelliaddy   </Option>
<Option>    Neluwa  </Option>
<Option>    Nikaweratiya    </Option>
<Option>    Nikaweratiya Division   </Option>
<Option>    Nilaweli    </Option>
<Option>    Nildandahinna   </Option>
<Option>    Nittambuwa  </Option>
<Option>    Nivithigala </Option>
<Option>    Nochchiyagama   </Option>
<Option>    Norochchola </Option>
<Option>    North Central Province  </Option>
<Option>    North Western Province  </Option>
<Option>    Northern Province   </Option>
<Option>    Norton Bridge   </Option>
<Option>    Norwood </Option>
<Option>    Nugegoda    </Option>
<Option>    Nugegoda Division   </Option>
<Option>    Nuwara Eliya    </Option>
<Option>    Nuwara Eliya Division   </Option>
<Option>    Oddusudsn   </Option>
<Option>    Okkampitiya </Option>
<Option>    Omanthai    </Option>
<Option>    Ombudsman   </Option>
<Option>    Opanayake   </Option>
<Option>    Organized Crimes and Criminal Intelligence Division </Option>
<Option>    Organized Crimes Preventive Division    </Option>
<Option>    Other   </Option>
<Option>    Padaviya    </Option>
<Option>    Padiyathalawa   </Option>
<Option>    Padukka </Option>
<Option>    Palali  </Option>
<Option>    Palei   </Option>
<Option>    Pallama </Option>
<Option>    Pallebedda  </Option>
<Option>    Pallekele (Balagolla)   </Option>
<Option>    Pallewela   </Option>
<Option>    Pamunugama  </Option>
<Option>    Panadura    </Option>
<Option>    Panadura Division   </Option>
<Option>    Panadura North  </Option>
<Option>    Panadura South  </Option>
<Option>    Panama  </Option>
<Option>    Panamura    </Option>
<Option>    Pannala </Option>
<Option>    Panwila </Option>
<Option>    Parasangaswewa  </Option>
<Option>    Parayanalakulam </Option>
<Option>    Parliament Division </Option>
<Option>    Passara </Option>
<Option>    Pattipola   </Option>
<Option>    Payagala    </Option>
<Option>    Peliyagoda  </Option>
<Option>    Pelmadulla  </Option>
<Option>    Peradeniya  </Option>
<Option>    Personnel B Division    </Option>
<Option>    Personnel Division  </Option>
<Option>    Pesale  </Option>
<Option>    Pettah  </Option>
<Option>    PHTI    </Option>
<Option>    Physical Assets Management  </Option>
<Option>    Piliyandala </Option>
<Option>    Pindeniya   </Option>
<Option>    Pinnawala   </Option>
<Option>    Pitabeddara </Option>
<Option>    Pitigala    </Option>
<Option>    Poddala </Option>
<Option>    Point Pedro </Option>
<Option>    Polgahawela </Option>
<Option>    Police Headquarters     </Option>
<Option>    Police Media Division   </Option>
<Option>    Police Medical Service  </Option>
<Option>    Police Medical Service Kundasale    </Option>
<Option>    Police Public Relation  </Option>
<Option>    Polonnaruwa </Option>
<Option>    Polonnaruwa Division    </Option>
<Option>    Polpithigama    </Option>
<Option>    Pothuhera   </Option>
<Option>    Pothuvil    </Option>
<Option>    Presidential Security Division  </Option>
<Option>    Prime Ministers Security Division   </Option>
<Option>    Pudukuduiruppu  </Option>
<Option>    Pugoda  </Option>
<Option>    Pujapitiya  </Option>
<Option>    Pulasthigama    </Option>
<Option>    Puliyankulam    </Option>
<Option>    Pulmudai    </Option>
<Option>    Punareen    </Option>
<Option>    Pundalu-Oya </Option>
<Option>    Pussellawa  </Option>
<Option>    Puttalam    </Option>
<Option>    Puttalam Division   </Option>
<Option>    Puwarsankulam   </Option>
<Option>    Raddolugama </Option>
<Option>    Ragala  </Option>
<Option>    Ragama  </Option>
<Option>    Rajanganaya </Option>
<Option>    Rakwana </Option>
<Option>    Rambodagalla    </Option>
<Option>    Rambukkana  </Option>
<Option>    Rangala </Option>
<Option>    Rasnayakapura   </Option>
<Option>    Ratgama </Option>
<Option>    Rathnapura  </Option>
<Option>    Rathnapura Division </Option>
<Option>    Rattota </Option>
<Option>    Recruitment Office  </Option>
<Option>    Research & Development  </Option>
<Option>    Research & Planning     </Option>
<Option>    Rideegama   </Option>
<Option>    Ridimaliyadda   </Option>
<Option>    Rotumba </Option>
<Option>    RPTS Akuramboda </Option>
<Option>    RPTS Boralanda  </Option>
<Option>    RPTS Katana </Option>
<Option>    RPTS Kundasale  </Option>
<Option>    RPTS Mahiyangana    </Option>
<Option>    RPTS Morawewa   </Option>
<Option>    RPTS Pahalagama </Option>
<Option>    Ruwanwella  </Option>
<Option>    Sabaragamuwa Province   </Option>
<Option>    Saliyawewa  </Option>
<Option>    Samanthurai </Option>
<Option>    Sampoor </Option>
<Option>    Sapugaskanda    </Option>
<Option>    Seeduwa </Option>
<Option>    Seethawakapura Division </Option>
<Option>    Serunuwara  </Option>
<Option>    Sevanagala  </Option>
<Option>    Sigiriya    </Option>
<Option>    Silawathura </Option>
<Option>    Siripagama  </Option>
<Option>    Siyambalanduwa  </Option>
<Option>    Slave Islande   </Option>
<Option>    SLPC Aralaganwila   </Option>
<Option>    SLPC Asgiriya   </Option>
<Option>    SLPC Boralanda  </Option>
<Option>    SLPC Elpitiya   </Option>
<Option>    SLPC Kalladi    </Option>
<Option>    SLPC Kalutara   </Option>
<Option>    SLPC Katana </Option>
<Option>    SLPC Kundasale  </Option>
<Option>    SLPC Mahiyangana    </Option>
<Option>    SLPC Nikaweratiya   </Option>
<Option>    SLPC Pahalagama </Option>
<Option>    SLPR Hqrs   </Option>
<Option>    Sooriyapura </Option>
<Option>    Sooriyawewa </Option>
<Option>    Southern Province   </Option>
<Option>    Special Branch  </Option>
<Option>    Special Investigation Unit  </Option>
<Option>    Sports Division </Option>
<Option>    Sripura </Option>
<Option>    State Intelligence Service  </Option>
<Option>    Statistics  </Option>
<Option>    STF </Option>
<Option>    STF  Akmeemana Camp </Option>
<Option>    STF  Aluthgama Camp </Option>
<Option>    STF  Aralaganwila Sub Camp  </Option>
<Option>    STF  Aranthalawa Camp   </Option>
<Option>    STF  Bandirekka Sub Camp    </Option>
<Option>    STF  Buddangala Sub Camp    </Option>
<Option>    STF  Buddangala Sub Camp    </Option>
<Option>    STF  Dambulla Camp  </Option>
<Option>    STF  Debarawewa Camp    </Option>
<Option>    STF  Deniyaya Camp  </Option>
<Option>    STF  Eravur Sub Camp    </Option>
<Option>    STF  Gampola Camp   </Option>
<Option>    STF  Ganeshapuram Camp  </Option>
<Option>    STF  Hambantota Camp    </Option>
<Option>    STF  Haputale Camp  </Option>
<Option>    STF  Headquarters   </Option>
<Option>    STF  Jaffna Camp    </Option>
<Option>    STF  Kahawatta Camp </Option>
<Option>    STF  Kalawanchikudi Camp    </Option>
<Option>    STF  Kalubowila Camp    </Option>
<Option>    STF  Kandy Camp </Option>
<Option>    STF  Kantale Camp   </Option>
<Option>    STF  Katharagama Camp   </Option>
<Option>    STF  Kebithigollewa Camp    </Option>
<Option>    STF  Kegalle Camp   </Option>
<Option>    STF  Kilinochchi Camp   </Option>
<Option>    STF  Kirindiwela Sub Camp   </Option>
<Option>    STF  Kurunegala Camp    </Option>
<Option>    STF  Lahugala Camp  </Option>
<Option>    STF  Madiwela Camp  </Option>
<Option>    STF  Mahagamasekara Sub Camp    </Option>
<Option>    STF  Mahaoya Camp   </Option>
<Option>    STF  Mankulam Camp  </Option>
<Option>    STF  Mannar Camp    </Option>
<Option>    STF  Maradana Camp  </Option>
<Option>    STF  Maskeliya Camp </Option>
<Option>    STF  Mulathivu Camp </Option>
<Option>    STF  Nuwaraeliya Camp   </Option>
<Option>    STF  Passara Camp   </Option>
<Option>    STF  PMSD, Kollupitiya Camp </Option>
<Option>    STF  Puliyankulam Camp  </Option>
<Option>    STF  Pulmudai Camp  </Option>
<Option>    STF  Puwarasankulam Camp    </Option>
<Option>    STF  Rajagiriya Camp    </Option>
<Option>    STF  Rathnapura Sub Camp    </Option>
<Option>    STF  Rear Headquarters  </Option>
<Option>    STF  Samanthurai Camp   </Option>
<Option>    STF  Settikulam Camp    </Option>
<Option>    STF  Shasthrawela Camp  </Option>
<Option>    STF  Siyambalanduwa Camp    </Option>
<Option>    STF  Tangalle Camp  </Option>
<Option>    STF  Thirukkovil Camp   </Option>
<Option>    STF  Training School    </Option>
<Option>    STF  Trincomalee Camp   </Option>
<Option>    STF  Udawalawa Camp </Option>
<Option>    STF  Vavunathivu Camp   </Option>
<Option>    STF  Vavuniya Camp  </Option>
<Option>    STF  Welipitiya Sub Camp    </Option>
<Option>    STF 02 Mile Post    </Option>
<Option>    STF 03 Mile Post    </Option>
<Option>    STF 05 Mile Post    </Option>
<Option>    STF 08 Mile Post    </Option>
<Option>    STF 10 Mile Post    </Option>
<Option>    STF 12 Kolaniya </Option>
<Option>    STF 13 Kolaniya </Option>
<Option>    STF 14 Kolaniya </Option>
<Option>    STF 16 Colaniya </Option>
<Option>    STF 17 Mile Post    </Option>
<Option>    STF 18 Mill Post    </Option>
<Option>    STF 233 Balasena Mulasthanaya   </Option>
<Option>    STF 38 Kolaniya </Option>
<Option>    STF 38 Mile Post    </Option>
<Option>    STF 3rd Mile Post Camp  </Option>
<Option>    STF Abimanapura </Option>
<Option>    STF Admin Division  </Option>
<Option>    STF Aiththamale </Option>
<Option>    STF Akkarapattuwa   </Option>
<Option>    STF Alamkulam   </Option>
<Option>    STF Ambakote    </Option>
<Option>    STF Ambalangoda </Option>
<Option>    STF Ambalanthota Camp   </Option>
<Option>    STF Ambalanthure    </Option>
<Option>    STF Ambanpola   </Option>
<Option>    STF Ambawathttha    </Option>
<Option>    STF Ampara Camp </Option>
<Option>    STF Angunakolapelessa   </Option>
<Option>    STF Annamalei   </Option>
<Option>    STF Anuradhapura Camp   </Option>
<Option>    STF Aralaganwila    </Option>
<Option>    STF Ariyampadhi </Option>
<Option>    STF Ariyampaththuwa </Option>
<Option>    STF Arugambe Camp   </Option>
<Option>    STF AThurugiriya Express Way Post   </Option>
<Option>    STF Atuchena    </Option>
<Option>    STF Badalkubura </Option>
<Option>    STF Badamassawa </Option>
<Option>    STF Badulla </Option>
<Option>    STF Badulugaha Juncion Camp </Option>
<Option>    STF Baduluhandiya   </Option>
<Option>    STF Bakmitiyawa </Option>
<Option>    STF Bamburegala </Option>
<Option>    STF Batticaloa  </Option>
<Option>    STF Battohandiya    </Option>
<Option>    STF Beliattha   </Option>
<Option>    STF Bibila  </Option>
<Option>    STF Boburuella  </Option>
<Option>    STF Bogamuyaya  </Option>
<Option>    STF Borapola    </Option>
<Option>    STF Building Division   </Option>
<Option>    STF Buttala Camp    </Option>
<Option>    STF Communication Division  </Option>
<Option>    STF Computer Division   </Option>
<Option>    STF Cross Juntion   </Option>
<Option>    STF Cultural Division   </Option>
<Option>    STF Dambagalla  </Option>
<Option>    STF Danagiriya  </Option>
<Option>    STF Darampalava </Option>
<Option>    STF Darampalawa </Option>
<Option>    STF Diddenipotha    </Option>
<Option>    STF Digawapiya  </Option>
<Option>    STF Dutuwewa    </Option>
<Option>    STF Ethakada    </Option>
<Option>    STF Ethakadha   </Option>
<Option>    STF Galanigama Express Way Post </Option>
<Option>    STF Galle   </Option>
<Option>    STF Gonahena    </Option>
<Option>    STF Hambegamuwa </Option>
<Option>    STF Hanawalvila </Option>
<Option>    STF Horana Camp </Option>
<Option>    STF Hulannuge   </Option>
<Option>    STF Human Resources Management  </Option>
<Option>    STF Humbegamuwa </Option>
<Option>    STF Idigollewa  </Option>
<Option>    STF Iluppadichena   </Option>
<Option>    STF Information Technology Division </Option>
<Option>    STF Int Division    </Option>
<Option>    STF Janadipathimedura   </Option>
<Option>    STF Janapada    </Option>
<Option>    STF Jayawardanapura Camp    </Option>
<Option>    STF Kaburupitiya    </Option>
<Option>    STF Kaddankulam </Option>
<Option>    STF Kahambana   </Option>
<Option>    STF Kahatagollewa   </Option>
<Option>    STF Kakachchiwatta  </Option>
<Option>    STF Kalladi </Option>
<Option>    STF Kalmunai Camp   </Option>
<Option>    STF Kalupalama  </Option>
<Option>    STF Kaluppukulam    </Option>
<Option>    STF Kanagarayankulama   </Option>
<Option>    STF Kanchanakuda    </Option>
<Option>    STF Kanchikudiaru   </Option>
<Option>    STF Kanchnakuda Camp    </Option>
<Option>    STF Kanchurankuda   </Option>
<Option>    STF Kankankulama    </Option>
<Option>    STF Kannagipuram    </Option>
<Option>    STF Karadandawa </Option>
<Option>    STF Karadaoya   </Option>
<Option>    STF Karadaoya   </Option>
<Option>    STF Karadiyanaru    </Option>
<Option>    STF Karagahaella    </Option>
<Option>    STF Karthiv </Option>
<Option>    STF Kathtankudi </Option>
<Option>    STF Katukurunda Camp    </Option>
<Option>    STF Kelaniya Camp   </Option>
<Option>    STF Kelapuliyankulam    </Option>
<Option>    STF Keviliyamadu    </Option>
<Option>    STF Kibithgollewa   </Option>
<Option>    STF Kiraan  </Option>
<Option>    STF Kithula </Option>
<Option>    STF Kohombagasthalawa   </Option>
<Option>    STF Kokkadichole    </Option>
<Option>    STF Komari  </Option>
<Option>    STF Kopaweli    </Option>
<Option>    STF Kosgolla    </Option>
<Option>    STF Kotiyagala  </Option>
<Option>    STF Kotteviharaya   </Option>
<Option>    STF Kovil Juntion   </Option>
<Option>    STF Kovilhandiya    </Option>
<Option>    STF Kridahandiya    </Option>
<Option>    STF Kudaloluwa  </Option>
<Option>    STF Kulawana    </Option>
<Option>    STF Kumana  </Option>
<Option>    STF Kurukkalmadam   </Option>
<Option>    STF Kurukkalpudikulam   </Option>
<Option>    STF Kurundugaha Hatakma Express Way Post    </Option>
<Option>    STF Kurusa Junction </Option>
<Option>    STF Kurusuddamadu   </Option>
<Option>    STF Kuruwancheli    </Option>
<Option>    STF Lake 01 </Option>
<Option>    STF Leweniaru   </Option>
<Option>    STF Liyanagolla </Option>
<Option>    STF Liyanagolla </Option>
<Option>    STF Logistic Division   </Option>
<Option>    STF Maddiya Kadaura </Option>
<Option>    STF Madupara    </Option>
<Option>    STF Mahanikawewa    </Option>
<Option>    STF Mailanbawali    </Option>
<Option>    STF Mailavettuwan   </Option>
<Option>    STF Maligavichchi   </Option>
<Option>    STF Maligavila  </Option>
<Option>    STF Malwatta    </Option>
<Option>    STF Mandure </Option>
<Option>    STF Mangalagama </Option>
<Option>    STF Manmoona    </Option>
<Option>    STF Mantottama  </Option>
<Option>    STF Maradhamuna </Option>
<Option>    STF Marapalama  </Option>
<Option>    STF Matale  </Option>
<Option>    STF Matara  </Option>
<Option>    STF Matottama   </Option>
<Option>    STF Mawadivummari   </Option>
<Option>    STF Meepilimanna    </Option>
<Option>    STF Melevidiya  </Option>
<Option>    STF Monaragala  </Option>
<Option>    STF Monarathenna    </Option>
<Option>    STF Moratottanchena </Option>
<Option>    STF Moratuwa Camp   </Option>
<Option>    STF Morayaya    </Option>
<Option>    STF Munrumurippukulama  </Option>
<Option>    STF Murunkan    </Option>
<Option>    STF Muwamilade  </Option>
<Option>    STF Nadidankulama   </Option>
<Option>    STF Nanattan    </Option>
<Option>    STF Narakamulla 01  </Option>
<Option>    STF Narakamulla 02  </Option>
<Option>    STF Narakamulla 03  </Option>
<Option>    STF Narakamulla 2 Camp  </Option>
<Option>    STF Naripulthottama </Option>
<Option>    STF Nawakkulam  </Option>
<Option>    STF Nedukkulam  </Option>
<Option>    STF Neeththa    </Option>
<Option>    STF Nelliyankudiruppu   </Option>
<Option>    STF Nikawewa    </Option>
<Option>    STF Niknode </Option>
<Option>    STF Nugelandha  </Option>
<Option>    STF Nuwaragalathenna    </Option>
<Option>    STF Okada   </Option>
<Option>    STF Oluvil  </Option>
<Option>    STF Ondachimadam    </Option>
<Option>    STF Paladiwattha    </Option>
<Option>    STF Pallachena  </Option>
<Option>    STF Palugamam   </Option>
<Option>    STF Panama  </Option>
<Option>    STF Panikkaraikulam </Option>
<Option>    STF Pankudaweli </Option>
<Option>    STF Pannalgama  </Option>
<Option>    STF Parayanakulam Camp  </Option>
<Option>    STF Pattipola   </Option>
<Option>    STF Pawakkudichena  </Option>
<Option>    STF Pelwaththa  </Option>
<Option>    STF Perawelithalawa </Option>
<Option>    STF Periyamadu  </Option>
<Option>    STF Piliyandala </Option>
<Option>    STF Pilleyaradi </Option>
<Option>    STF Pillumalei  </Option>
<Option>    STF Pinnaduwa Express Way Post  </Option>
<Option>    STF Pirappanmadu 01 </Option>
<Option>    STF Pirappanmadu 02 </Option>
<Option>    STF Piyangala   </Option>
<Option>    STF Point Pedro </Option>
<Option>    STF Polonnaruwa Sub Camp    </Option>
<Option>    STF Porathiv    </Option>
<Option>    STF Potuvil </Option>
<Option>    STF Property Management Division    </Option>
<Option>    STF Pudikudiruppuwa </Option>
<Option>    STF Pudukudiiruppu Camp </Option>
<Option>    STF Pugoda Camp </Option>
<Option>    STF Pulawalee   </Option>
<Option>    STF Puliyankulama 02    </Option>
<Option>    STF Pulleadiirakkam </Option>
<Option>    STF Pulukunava  </Option>
<Option>    STF Pulukunawa Camp </Option>
<Option>    STF Puttlam Camp    </Option>
<Option>    STF Radella </Option>
<Option>    STF Rankaduvegoda   </Option>
<Option>    STF Rankaduwegoda   </Option>
<Option>    STF Rathgama    </Option>
<Option>    STF Rottekulam  </Option>
<Option>    STF Rugama  </Option>
<Option>    STF Rupaskulam  </Option>
<Option>    STF Rupawahini  </Option>
<Option>    STF Sagama  </Option>
<Option>    STF Saharukondan    </Option>
<Option>    STF Samanthiaru </Option>
<Option>    STF Samanturiy  </Option>
<Option>    STF Sangamankanda   </Option>
<Option>    STF Santhimale  </Option>
<Option>    STF Search and Bomb Disposal Division   </Option>
<Option>    STF Seeduwa Express Way Post    </Option>
<Option>    STF Senagamuwewa    </Option>
<Option>    STF Settipalama </Option>
<Option>    STF Settipalama </Option>
<Option>    STF Sewanagala  </Option>
<Option>    STF Sinnapuliyankulam   </Option>
<Option>    STF Sinnaurni   </Option>
<Option>    STF Sinnawaththa    </Option>
<Option>    STF Sirikotha   </Option>
<Option>    STF Sooriyakattanadu    </Option>
<Option>    STF Sooriyawewa Camp    </Option>
<Option>    STF Sorikalmuna </Option>
<Option>    STF Sport Division  </Option>
<Option>    STF Tangawaladipuram    </Option>
<Option>    STF Tempitiya   </Option>
<Option>    STF Thalawai    </Option>
<Option>    STF Thalawakele Camp    </Option>
<Option>    STF Thambanekulam   </Option>
<Option>    STF Thanamalvila    </Option>
<Option>    STF Thikkodai   </Option>
<Option>    STF Thumpalanchola  </Option>
<Option>    STF Torinton    </Option>
<Option>    STF Transport Division  </Option>
<Option>    STF Tummulla    </Option>
<Option>    STF Tumpankerani    </Option>
<Option>    STF Udimbikulam </Option>
<Option>    STF Unnachchiya </Option>
<Option>    STF Urani   </Option>
<Option>    STF Urasari </Option>
<Option>    STF Urubokka    </Option>
<Option>    STF Uyangolla   </Option>
<Option>    STF Valigahakandiya </Option>
<Option>    STF Varikuttu East  </Option>
<Option>    STF Varikuttu West  </Option>
<Option>    STF Vellavali   </Option>
<Option>    STF Velvetithurai   </Option>
<Option>    STF Vembiyadikulam  </Option>
<Option>    STF Veppavettuvan   </Option>
<Option>    STF Vidundikulam    </Option>
<Option>    STF Viharahalmillewa    </Option>
<Option>    STF Wadinagala  </Option>
<Option>    STF Walasmulla  </Option>
<Option>    STF Waligahakandiya Camp    </Option>
<Option>    STF Wankale </Option>
<Option>    STF Waranagama  </Option>
<Option>    STF Weherakema  </Option>
<Option>    STF Welfare Division    </Option>
<Option>    STF Welikada    </Option>
<Option>    STF Wijerama Sub Camp   </Option>
<Option>    STF Wordpedesa  </Option>
<Option>    STF Yakawewa    </Option>
<Option>    STF Yalabowa    </Option>
<Option>    STF Yodawewa    </Option>
<Option>    Supplies    </Option>
<Option>    Talaimannar </Option>
<Option>    Talathuoya  </Option>
<Option>    Tangalle    </Option>
<Option>    Tangalle Division   </Option>
<Option>    Teldeniya   </Option>
<Option>    Tell IGP    </Option>
<Option>    Terrorist Investigation Division    </Option>
<Option>    Thalangama  </Option>
<Option>    Thalawa </Option>
<Option>    Thalawakele </Option>
<Option>    Thambalagamuwa  </Option>
<Option>    Thambuttegama   </Option>
<Option>    Thanamalwila    </Option>
<Option>    Thanthirimale   </Option>
<Option>    Thebuwana   </Option>
<Option>    Thelikada   </Option>
<Option>    Thellippalai    </Option>
<Option>    Theripehe   </Option>
<Option>    Thihagoda   </Option>
<Option>    Thiniyawala </Option>
<Option>    Thirappane  </Option>
<Option>    Thirukkowil </Option>
<Option>    Thissamaharama  </Option>
<Option>    Tourist Police  </Option>
<Option>    Traffic Admin & Road Safety </Option>
<Option>    Transport Division  </Option>
<Option>    Transport Division Ampara   </Option>
<Option>    Transport Division Anuradhapura </Option>
<Option>    Transport Division Bingiriya    </Option>
<Option>    Transport Division Jaffna   </Option>
<Option>    Transport Division Kalutara </Option>
<Option>    Transport Division Kundasale    </Option>
<Option>    Transport Division Matara   </Option>
<Option>    Transport Division Narahenpita  </Option>
<Option>    Transport Division Trincomalee  </Option>
<Option>    Transport Division Vavuniya </Option>
<Option>    Trinco-Harbour  </Option>
<Option>    Trincomalee </Option>
<Option>    Trincomalee Division    </Option>
<Option>    Udamaluwa   </Option>
<Option>    Udappuwa    </Option>
<Option>    Udawalawa   </Option>
<Option>    Ududumbara  </Option>
<Option>    Udugama </Option>
<Option>    Udupussellawa   </Option>
<Option>    Uhana   </Option>
<Option>    Ulukkulama  </Option>
<Option>    Uppuveli    </Option>
<Option>    Uragasmanhandiya    </Option>
<Option>    Urubokka    </Option>
<Option>    Uva Paranagama  </Option>
<Option>    Uva Province    </Option>
<Option>    Valachchenai    </Option>
<Option>    Vaunathivu  </Option>
<Option>    Vavuniya    </Option>
<Option>    Vavuniya Division   </Option>
<Option>    Vellavely   </Option>
<Option>    Velvetithurai   </Option>
<Option>    Veyangoda   </Option>
<Option>    Victims Of Crime And Witnesses Assistance And  Protection Division  </Option>
<Option>    Wadduwa </Option>
<Option>    Wadukotte   </Option>
<Option>    Wakarai </Option>
<Option>    Walapone    </Option>
<Option>    Walasmulla  </Option>
<Option>    Wanathawilluwa  </Option>
<Option>    Wanduramba  </Option>
<Option>    Wan-Ela </Option>
<Option>    Wankalai    </Option>
<Option>    Warakagoda  </Option>
<Option>    Warakapola  </Option>
<Option>    Wariyapola  </Option>
<Option>    Watawala    </Option>
<Option>    Wattala </Option>
<Option>    Wattegama   </Option>
<Option>    Wedithalthivu (Adappan) </Option>
<Option>    Weeraketiya </Option>
<Option>    Weerambugedara  </Option>
<Option>    Weerangula  </Option>
<Option>    Weeravila   </Option>
<Option>    Welambada   </Option>
<Option>    Welfare Division    </Option>
<Option>    Weligama    </Option>
<Option>    Weligepola  </Option>
<Option>    Welikada    </Option>
<Option>    Welikanda   </Option>
<Option>    Welimada    </Option>
<Option>    Welioya </Option>
<Option>    Welipenna   </Option>
<Option>    Weliweriya  </Option>
<Option>    Wellampitiya    </Option>
<Option>    Wellawa </Option>
<Option>    Wellawatta  </Option>
<Option>    Wellawaya   </Option>
<Option>    Wennappuwa  </Option>
<Option>    Western Province    </Option>
<Option>    Western Province Intelligence Bureau    </Option>
<Option>    Wewelwatta  </Option>
<Option>    Wilgamuwa   </Option>
<Option>    Woulfendhal </Option>
<Option>    WP North Crime Division </Option>
<Option>    WP North Traffic Division   </Option>
<Option>    Yakkala </Option>
<Option>    Yakkalamulla    </Option>
<Option>    Yatawatta   </Option>
<Option>    Yatiyantota </Option>


                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tittle of the Letter(English)</label>
                            <textarea name="address1" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Tittle of the Letter(Sinhala)</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address1_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address1_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Date of receipt / referral</label>
                            <input type="date" required="required" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Issue Date</label>
                            <input type="date" name="salary1" class="form-control <?php echo (!empty($salary1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary1_err;?></span>
                        </div>


                            <div class="form-group">
                            <label>Calender Date</label>
                            <input type="date" name="address2" class="form-control <?php echo (!empty($$address2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $address2_err;?></span>
                        </div>


                          <div class="form-group">
                            <label>Calender Date For DIG</label>
                            <input type="date" name="address3" class="form-control <?php echo (!empty($$address3_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $address3_err;?></span>
                        </div>


                            <div class="form-group">
                            <label>Soft copy of the letter</label>
                            <input type="file" required="required" name="photo" class="form-control <?php echo (!empty($file_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $file; ?>" id="fileSelect">
                            <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png, .pdf formats allowed to a max size of 5 MB.</p>
                        </div>

                         <div class="form-group">
                            <label>who accepted the letter</label>
                            <input type="name" name="address4" class="form-control <?php echo (!empty($$address4_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $address4_err;?></span>
                        </div>



                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <input type="reset" class="btn btn-secondary" name="reset" value="Cancel">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>