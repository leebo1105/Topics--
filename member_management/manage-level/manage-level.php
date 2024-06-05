
<style>
    .progress {
        width: 100%;
    }
</style>
  
<div>
    <label for="manage-level" class="py-3">目前累積消費</label>
    <input name="manage-level" class="" type="number" id="manage-level" min="0"  value="<?= $totalPrice ?>" readonly>
    <span>
        會員等級 
        <span id="spanText" class="fs-4 text-warning "></span>
        <span id="spanText1" class="fs-6 px-2"></span>
        
    </span>
</div>

<div class="progress">
    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="0" style="width: 0;"></div>
</div>

<script>
var maxVal = 0;
var membershipLevel = ""; // 會員等級
var nextLevelAmount  = 2000; // 差多少金額升級

// 累積金額 max 初始值
setMaxValue(2000); 

// 引入輸入框 Max
function setMaxValue(newValue) {
    maxVal = newValue;
    document.getElementById('manage-level').setAttribute('max', maxVal);
    document.getElementById('progress-bar').setAttribute('aria-valuemax', maxVal);
}

function updateProgressBar() {
    var inputVal = parseInt(document.getElementById('manage-level').value);
        var progressBar = document.getElementById('progress-bar');

        // 計算進度條的寬度
        value = (inputVal / maxVal) * 100;
        progressBar.style.width = value + '%';

        // inputVal = maxVal, 設置新的 maxVal
        if(inputVal < 2000){
          
            membershipLevel = "VIP";
        }
        if(inputVal >= maxVal){
            maxVal += 5000; //增加 maxVal 
            document.getElementById('manage-level').setAttribute('max',maxVal);
            progressBar.setAttribute('aria-valuemax', maxVal);
           
            membershipLevel = "VIP999";
        }if(inputVal >= 7000){
            maxVal += 5000; //增加 maxVal 
            document.getElementById('manage-level').setAttribute('max',maxVal);
            progressBar.setAttribute('aria-valuemax', maxVal);
            
            membershipLevel = "魔關羽";
        }if(inputVal >= 12000){ // 最高 20000
            maxVal += 8000; //增加 maxVal 
            document.getElementById('manage-level').setAttribute('max',maxVal);
            progressBar.setAttribute('aria-valuemax', maxVal);

            membershipLevel = "尊貴會員";
        }
        nextLevelAmount = maxVal - inputVal;
        // 重新計算進度條的寬度
        value = (inputVal / maxVal) * 100;
        progressBar.style.width = value + '%';
       
        document.getElementById('spanText').innerText = membershipLevel;
        document.getElementById('spanText1').innerText = `再消費 ${nextLevelAmount} 即可升級`;
    }

    // 初始化進度條
    window.onload = updateProgressBar;
</script>
