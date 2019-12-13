
function requestToServer(url,data,method = "POST") {
        const promise = new Promise( (resolve, reject)=>{
            const xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');  
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('server 200')
                    resolve(xhr.responseText);
                } else {
                    if (xhr.readyState === 4) reject(`Запрос завершён с кодом ответа: ${xhr.status}`)
                } 

            };
            console.log('--:','send: ', data )
            let s = "";
            for (let key in data) {
                s +=`${key}=${data[key]}&`;
            }
            s = s.slice(0,-1);
            xhr.send(s);
        })
        return promise;
    }


export default requestToServer;

