const apiKey="949dde68db26bf7b7b52e01c2686bfdb"
const apiUrl="https://api.openweathermap.org/data/2.5/weather?&units=metric&q="

const searchbox = document.querySelector(".search input");
const searchbtn = document.querySelector(".search button");
// const weather_icon = document.querySelector(".weather img")



async function checkweather(city){
    


    const respones = await fetch(apiUrl + city + `&appid=${apiKey}`);

    var data = await respones.json()

    // console.log(data)

    // document.querySelector(".city").innerHTML = data.name 
    // document.querySelector(".temp").innerHTML = Math.round(data.main.temp) + "°C"
    
    window.location.href="saveData.php?city="+data.name+"&temp="+data.main.temp+"&weather="+data.weather[0].main


    
    
    
    
    
    
    
}



searchbox.addEventListener("keypress", function (e){
    if (e.key === 'Enter') {
        checkweather(searchbox.value)
    }
})
    



searchbtn.addEventListener("click",()=>{
    checkweather(searchbox.value)
})





