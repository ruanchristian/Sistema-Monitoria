const imgs = [
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3917811?code=dc3bc8cfc3cf8b23914618ba70040f043be02897363af292465146b11f128846",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4669171?code=cbc31c9646b2e25b1144fd5ae05e34c993eb46fcefe987c7d350c6eecf21a867",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2233176?code=ee4ecb7a3d8b2e783da71242e73aafc0dd1738fd359744530a4876392274b678",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2228637?code=f3bf424b7cc4ecc3807b5dd88ab9ed85648835db5482d27c6877e0df00fc44e1",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1568893?code=f17c2093534a265e3c2b6f8a3cc038bfdb9475f87bde21f62114566320fd119b",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1843110?code=9a29249ac84c54e618fed83980658ee9ff1bc5283db2b4e10bbdf707124adc6a",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3523789?code=8ea98ad145f530fad399499ed5fe22cede6ab5240946db318da2617a060ea100",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1878928?code=65ef74472bf9d45cb4beb07323ee0dd6a19774c947356d21f6fd5000cd30ce75",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2125443?code=03cdd4508fc7aaf647f08d2cf2af588d37d82a0a435504287bbf2cd37a35195b",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3148182?code=7c61b757d403c9431fd183d3de13ccb5cd51d43cd66ce43af1205ea2342e34a7",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1911965?code=93a3a52b74dd3ea725906ac728b3c260eb6743c25799fd9220e28490e2de2514",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4661912?code=87312990a3c091b7eb197c34cc6c7c7109da67c2e9b3786da71267517b022916",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4661653?code=d52651709731855f8fd799c52b957a4d95c445c34c083bcc5b304d6e09151a19",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3917862?code=9c3ed613ebeb192dd58ee28d79d3549d8d72416766ecbd3ed0d14b9218adf1fc",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2223712?code=69b9602798c610d0f24b9dbc4544601982ce02c083759cd75fc4fd5171da262d",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3793203?code=a3d1a5da9ed166e5fcdd3641d8ee379d40445e8fb7d0d5fda18f34e4caf5420f",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4662154?code=98f1b5b54142cffd741e39c135ca9ee47650819784f828b100ce6e980bbf03a2",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4669200?code=c303b4a9a313fe0a36fc9fdbbf8d460b019721e2b55e5889048a09c6f95ffff3",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2815544?code=09baccb2e4c8c9add27e5e7942afcdcf22d4b690b14932287095cad4b70fc040",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1905368?code=706acf3085baec488ad04c2956f20f8dbaa389898523f1daadc1a1125c178b0f",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4910141?code=d83604f521af816fe3640a3388bcca10a1360fe08e0e6f4f5679abf3a5e6ace1",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3145552?code=fc29177b6dd82ddafff2eef2d5a0bd6e097c476f28b4b66baba0e270d1927f11",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3917965?code=450a3db516075dacdaf3775f6482b9b85b9e480bfc56c78acd40bc16954e685f",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3989047?code=57911615d50db2358d5a89e3d50d95f834f963baf3697985cf2c560a67cb2b42",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1805187?code=312ceeba12c5fb0049729aeb15ef3cfe43fc298ae6588a575f32d4a0baf61d6a",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2802697?code=7bbfd06cdd999e4e7e0533e58d5691c3d606dfb3f28e91736ef48a49f057ec58",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4671764?code=f2da302382ff3a52f3af27d186b30e3568662f701e1f1af0c5f4ce5af3abb401",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2116896?code=214455b7fa5d6d3b81bef70b48253ffaf92c4097a3c62a77e4573fece3bf0257",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2899590?code=54264736fec1e6f7fd8534f8aa84a88a91af56efee6ebb8315d0ef1e03cc898f",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4361480?code=f24c81114a88559f9783fcc46dfcd08b36f3f49dc7558998ec94e503317825db",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2172557?code=f938bc06c1b542d46837091ae5841e9b15b971b59935b7d800d654c66ade843e",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/3411908?code=47b40283926af2bb55ac263db23b02227f39850dce27c2dbd012c854a50cb0e6",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4669138?code=ffb8d3e5586fe226b45d6d4dfc222ed75b7b4343322ed70b37e8abed5c4bc043",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1911162?code=5972f8a92c4fcab7a94777c05fab8e6800145061f7c2581ad04da49b0a65457f",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2171448?code=65b38d744ab7b8043f7755c79604a52664a0cb46f5305c72c86d6cacdea84333",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1597334?code=9e4820d0b7c775eee94cb4e0cae184c102b6c8495286d6a6cd48eb74de6f662c",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2226037?code=ca255160a074c1a4915a06a945f69a1e87fb3b2569388d8f738dd2e42083fe4b",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1845292?code=3e4d17b8c947898e41b5e64c2d241df9fca66d32e5906a9bc44b38d4bfb46fe4",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1569753?code=4bced04e9ba3b4c721a76ac7753bb33043f9ebfecb01a0a48a054b188b7eade2",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/2813728?code=5ef70d06f7e29527d20fc501ad3ba04117d757abeeaecd1f4acb99011bb5275e",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4662271?code=539379633d3afad9acd4ee31799a08bfc6005f2082ee627ef57597421ecc93e4",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/1850025?code=d1b0d8931c9d186f76a18a4f0790df9fbc2d521dd541ddc66f1f607b1cd0d5a9",
    "https://apiregistrofotografico.seduc.ce.gov.br/api/registrofotografico/aluno/4662228?code=ce73ce860cefb105c5b4b3883396a8b212628e912e0522b4cc0223db79dd1d2a"
]

const changeState = (checkbox, p) => {
    let state = document.getElementById(p);
    if (checkbox.checked) {
        state.innerHTML = "F";
        state.style.color = "red";
    } else {
        state.innerHTML = "P";
        state.style.color = "black";
    }
}

function forceOp() {
    //Função que vai forçar o usuário a digitar somente números no input text.
    var e = document.getElementById("field01");
    e.value = e.value.replace(/[^0-9]/gi, "");
}

function openIng() {
    window.open("https://www.instagram.com/study_informatica_2b/", "_blank");
    console.log('redirected successfully');
}