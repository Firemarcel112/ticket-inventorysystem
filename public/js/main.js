// Update Current Settings //

const URI = window.location.pathname;

// .. //

window.addEventListener("DOMContentLoaded", () => {

    if(URI !== "/login") {
        window.setTimeout("load()", 1);
        window.setInterval("update()", 1000/25);
    } else {
        window.setTimeout("load()", 1);
    }
})

function displayForm(form) {
    form = document.querySelector(`#${form}`);
    form.classList.remove('hidden');

    let forms = document.getElementsByClassName('assetsForm');
    Array.prototype.forEach.call(forms, element => {
        if(element.getAttribute('id') != form.getAttribute('id')) {
            element.classList.add('hidden');
        }
    });

}

function load() {
    let darkMode = document.querySelector("#toggler");
    let html = document.querySelector("html");

    if(localStorage.getItem("darkMode") == 0) {
        html.classList.remove("dark");


    }

    if(html.classList.contains("dark")) {
        if(URI !== '/login') {
            darkMode.setAttribute("checked", "true");
        }
    }
}

function update() {
    let darkMode = document.querySelector("#toggler");
    let html = document.querySelector("html");

    if(localStorage.getItem("darkMode") == 0) {
        html.classList.remove("dark");

    }

    if(html.classList.contains("dark")) {
        darkMode.setAttribute("checked", "true");

    }

    const body = document.querySelector("body");
    let sidebar = document.querySelector("#sidebar");


}

function toggleDarkmode() {
    let darkMode = document.querySelector("#toggler");
    let html = document.querySelector("html");

    html.classList.toggle("dark");
    let toggle;
    if (!html.classList.contains("dark")) {
        toggle = 0;
        localStorage.setItem("darkMode", toggle);
    } else {
        toggle = 1;
        localStorage.setItem("darkMode", toggle);
    }
}

function openMenu(id) {

    let elem = document.querySelector("#" + id);

    elem.classList.toggle("hidden");
    elem.classList.toggle("block");

}

function openMenuFAQ(contentDiv, headlineDiv) {
    let image = document.querySelector('#' + headlineDiv + ' path');
    let elem = document.querySelector(`#${contentDiv}`);
    elem.classList.toggle("hidden");
    elem.classList.toggle("block");

    if(image.classList.contains('plus')) {
        image.setAttribute('d', 'M250 604h461v-60H250v60Zm-70 332q-24 0-42-18t-18-42V276q0-24 18-42t42-18h600q24 0 42 18t18 42v600q0 24-18 42t-42 18H180Zm0-60h600V276H180v600Zm0-600v600-600Z');
    }
    else {
        image.setAttribute('d', 'M450 776h60V606h170v-60H510V376h-60v170H280v60h170v170ZM180 936q-24 0-42-18t-18-42V276q0-24 18-42t42-18h600q24 0 42 18t18 42v600q0 24-18 42t-42 18H180Zm0-60h600V276H180v600Zm0-600v600-600Z')
    }
    image.classList.toggle('plus');
    image.classList.toggle('minus');
}

function togglePW(input, icon) {
    input = document.querySelector("#" + input);
    icon = document.querySelector("#" + icon);

    if(input.type === "password") {
        input.type = "text";
        icon.setAttribute('d', 'M11 16.3h19.5v-4.8q0-2.7-1.9-4.6Q26.7 5 24 5q-2.7 0-4.6 1.9-1.9 1.9-1.9 4.6h-3q0-3.95 2.775-6.725Q20.05 2 24 2q3.95 0 6.725 2.775Q33.5 7.55 33.5 11.5v4.8H37q1.25 0 2.125.875T40 19.3V41q0 1.25-.875 2.125T37 44H11q-1.25 0-2.125-.875T8 41V19.3q0-1.25.875-2.125T11 16.3ZM11 41h26V19.3H11V41Zm13-7q1.6 0 2.725-1.1t1.125-2.65q0-1.5-1.125-2.725T24 26.3q-1.6 0-2.725 1.225T20.15 30.25q0 1.55 1.125 2.65Q22.4 34 24 34Zm-13 7V19.3 41Z')
    } else {
        input.type = "password";
        icon.setAttribute('d', 'M11 44q-1.25 0-2.125-.875T8 41V19.3q0-1.25.875-2.125T11 16.3h3.5v-4.8q0-3.95 2.775-6.725Q20.05 2 24 2q3.95 0 6.725 2.775Q33.5 7.55 33.5 11.5v4.8H37q1.25 0 2.125.875T40 19.3V41q0 1.25-.875 2.125T37 44Zm0-3h26V19.3H11V41Zm13-7q1.6 0 2.725-1.1t1.125-2.65q0-1.5-1.125-2.725T24 26.3q-1.6 0-2.725 1.225T20.15 30.25q0 1.55 1.125 2.65Q22.4 34 24 34Zm-6.5-17.7h13v-4.8q0-2.7-1.9-4.6Q26.7 5 24 5q-2.7 0-4.6 1.9-1.9 1.9-1.9 4.6ZM11 41V19.3 41Z')
    }
}

function copyColor(color, id) {
    navigator.clipboard.writeText(color);
}

function toggleLicense(showing, hiding){
    let show = document.getElementById(showing);
    let hide = document.getElementById(hiding);
    let infoLink = document.getElementById('licenseInfoLink');
    let usageLink = document.getElementById('licenseUsageLink');

    show.classList.add("block");
    show.classList.remove("hidden");
    hide.classList.add("hidden");
    hide.classList.remove("block");

    if (show === document.getElementById('licenseInfo')) {
        infoLink.classList.add("border-t-blue-500", "border-black", "font-extrabold");
        infoLink.classList.remove("border-t-transparent", "border-transparent", "font-bold");
        usageLink.classList.add("border-t-transparent", "border-transparent", "font-bold");
        usageLink.classList.remove("border-t-blue-500", "border-black", "font-extrabold");

    }
    else {
        infoLink.classList.remove("border-t-blue-500", "border-black", "font-extrabold");
        infoLink.classList.add("border-t-transparent", "border-transparent", "font-bold");
        usageLink.classList.remove("border-t-transparent", "border-transparent", "font-bold");
        usageLink.classList.add("border-t-blue-500", "border-black", "font-extrabold");
    }

}

function AjaxResponse(url, maxImages) {
    let xhr;
    if(window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let messageTicket = document.querySelector("#messageTicket");
            let tickets = xhr.response;
            tickets = JSON.parse(tickets);
            messageTicket.innerHTML = "";
            tickets.forEach((ticket => {
                let authorBox = document.createElement("div");
                let authorBoxFlex = document.createElement("div");
                authorBoxFlex.classList.add("imgBox");
                if (ticket.userid === ticket.creator) {
                    authorBox.classList.add("messageUser", "break-all");
                } else {
                    authorBox.classList.add("messageAdmin", "break-all");
                }
                let message = document.createElement("p");

                let messageContent = document.createTextNode(ticket.message);
                message.appendChild(messageContent);

                let imageBox = document.createElement("div")

                let msgInformation = document.createElement("p");
                let small = document.createElement("small");
                let date = new Date(ticket.created_at)
                let day = ((date.getDate() < 10) ? `0${date.getDate()}` : `${date.getDate()}`);
                let month = ((date.getMonth() + 1 < 10) ? `0${date.getMonth() + 1}` : `${date.getMonth() + 1}`);
                let year = date.getFullYear();
                let minutes = ((date.getMinutes() < 10) ? `0${date.getMinutes()}` : `${date.getMinutes()}`);
                let hour = ((date.getHours() < 10) ? `0${date.getHours()}` : `${date.getHours()}`);
                let formatDate = `${day}.${month}.${year} ${hour}:${minutes} Uhr`;

                let informationMessage = document.createTextNode(`${ticket.username}, ${formatDate}`);
                small.appendChild(informationMessage);
                msgInformation.appendChild(small);
                msgInformation.classList.add("text-right");

                let br = document.createElement("br");
                br.classList.add("clear-both");
                if (ticket.images !== "") {
                    let imagesrc = ticket.images.split("|");
                    let i = 1;
                    imagesrc.forEach((src => {
                        let ticketId = ticket.id;
                        let imageID = (ticketId * maxImages) + i;
                        i++;
                        i++;
                        let img = document.createElement("img");
                        let imageContainer = document.createElement("div");
                        imageContainer.setAttribute("id", `divImage${imageID}`)
                        img.classList.add("img", "w-24", "h-24", "cursor-pointer");
                        img.setAttribute("src", `/${src}`)
                        imageContainer.setAttribute("onclick", "scaleImage(this)");
                        imageContainer.appendChild(img);
                        authorBoxFlex.appendChild(imageContainer);
                    }));
                }

                authorBox.appendChild(message);
                authorBox.appendChild(authorBoxFlex);
                authorBox.appendChild(msgInformation);
                messageTicket.appendChild(authorBox);
                messageTicket.appendChild(br);
            }))
        }
    };
    xhr.open("GET", url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send();
}

function scaleImage(event) {
    let app = document.querySelector(".app");
    let aside = document.querySelector("aside");
    let header = document.querySelector("header");
    let footer = document.querySelector("footer");
    let imageBox = document.querySelector("#imageBox");
    let imageBoxImg = document.querySelector("#imageBox img");
    let closeBtn = document.querySelector("#imageBox span");
    let textarea = document.querySelector("#submitResponse textarea");
    let inputFile = document.querySelector("#submitResponse #inputMultiple");
    let btn = document.querySelector("#submitResponse button");
    let fileLabel = document.querySelector("#submitResponse label[for='inputMultiple']");
    console.log(event.id);
    if(!imageBox.classList.contains("fixed")) {
        if(event.id !== undefined) {
            let image = document.querySelector(`#${event.id} .img`);
            image = image.getAttribute('src');
            let heights = window.innerHeight * 0.85;
            heights = heights + "px";
            let minHeights = window.innerHeight * 0.4;
            minHeights = minHeights + "px";

            app.setAttribute("class", "transition-all app blur-sm select-none");
            aside.setAttribute("class", "transition-all blur-sm select-none");
            header.setAttribute("class", "transition-all blur-sm select-none");
            footer.setAttribute("class", "transition-all blur-sm select-none");
            imageBox.setAttribute("class", "transition-all cursor-pointer w-9/12 h-[40vh] md:w-1/2 md:h-[50vh] top-[5%] z-20 fixed mx-auto left-0 right-0 bg-no-repeat bg-100%");
            imageBoxImg.setAttribute("src", image);
            imageBoxImg.setAttribute("class", "mx-auto")
            imageBoxImg.style.maxHeight = heights;
            imageBoxImg.style.minHeight = minHeights;
            textarea.setAttribute("readonly", "true");
            textarea.setAttribute("class", "focus:border-none focus:outline-none cursor-default w-full h-48")
            inputFile.setAttribute("class", "hidden");
            fileLabel.setAttribute("class", "hidden");
            btn.setAttribute("disabled", "true");
            btn.setAttribute("class", "btn group bg-gradient-to-br from-red-600 to-red-300")
        }
    } else {
        app.setAttribute("class", "app");
        aside.removeAttribute("class");
        header.removeAttribute("class");
        footer.removeAttribute("class");
        imageBox.removeAttribute("style")
        imageBox.setAttribute("class", "hidden");
        textarea.removeAttribute("readonly");
        textarea.setAttribute("class", "w-full h-48");
        inputFile.removeAttribute("class");
        fileLabel.removeAttribute("class");
        btn.removeAttribute("disabled");
        btn.setAttribute("class", "btn group bg-gradient-to-br from-green-600 to-green-300")
    }
}

function addImage(i) {

    window.addEventListener('DOMContentLoaded', () => {

        let btn = document.querySelector("#addImage");
        let removeBtn = document.querySelector("#removeImage");
        let images = document.querySelector("#images");
        btn.addEventListener("click", () => {
            let imageDiv = document.createElement("div");
            imageDiv.setAttribute("class", "images--imageContainer")
            let img = document.createElement("input");
            let textarea = document.createElement("textarea");
            textarea.id = `imageDescription${i}`;
            img.type = 'file';
            img.setAttribute("name", "images[]");
            img.setAttribute("required", "true");
            img.setAttribute("class", "block w-full text-sm text-black cursor-pointer dark:text-white focus:outline-none dark:bg-gray-800");
            textarea.setAttribute("class", "w-full h-24");
            textarea.setAttribute("placeholder", "Bildbeschreibung eingeben");
            textarea.setAttribute("required", "true");
            textarea.setAttribute("name", "imageDescription[]");

            imageDiv.appendChild(img);
            imageDiv.appendChild(textarea);
            images.appendChild(imageDiv);
            if(removeBtn.classList.contains('!hidden')) { removeBtn.classList.toggle('!hidden')}

            i++;
        });
    });
}

function removeImage() {
    window.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector("#removeImage");
        btn.addEventListener("click", () => {
            let imageContainer = document.querySelector("#images");
            let images = imageContainer.querySelectorAll(".images--imageContainer");

            let arr = [];
            for (let i = 0, ref = arr.length = images.length; i < ref; i++) {
                arr[i] = images[i];
            }
            let imgRemove = arr.pop();
            imgRemove.remove();

            images = imageContainer.querySelectorAll(".images--imageContainer");

            if (images.length == 0) {
                btn.classList.toggle( "!hidden");
            }
        });
    });

}


