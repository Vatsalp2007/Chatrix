document.getElementById('otp_form').addEventListener('submit', function(e){
    e.preventDefault(); // prevent default form submit

    const formData = new FormData(this);

    fetch('send_otp.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('otp_msg').innerHTML = data;

        // ✅ Set hidden email input value for verify form
        const emailInput = document.querySelector('#otp_form input[name="email"]').value;
        document.getElementById('email_hidden').value = emailInput;

    })
    .catch(error => {
        document.getElementById('otp_msg').innerHTML = 'Error sending OTP';
        console.error(error);
    });
});

// ==================== Login OTP Verification ====================

document.getElementById('otp_verify_form').addEventListener('submit', function(e){
    e.preventDefault();

    const formData = new FormData(this);

    fetch('verify_otp.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            // Redirect to Chatrix.html
            window.location.href = "chatrix.php";
        } else {
            document.getElementById('otp_msg').innerHTML = data;
            document.getElementById('otp_msg').style.color = 'red';
        }
    })
    .catch(error => {
        document.getElementById('otp_msg').innerHTML = 'Something went wrong.';
        console.error(error);
    });
});

// ==================== Generate Signup OTP with strong password validation ====================

document.getElementById('generate_signup_otp').addEventListener('click', function(){
    const form = document.getElementById('signup_otp_form');

    const name = form.elements['name'].value.trim();
    const email = form.elements['email'].value.trim();
    const password = form.elements['password'].value.trim();

    // ✅ Validate inputs before sending fetch
    if (name === '' || email === '' || password === '') {
        document.getElementById('signup_otp_msg').innerText = 'Please fill all fields before generating OTP.';
        return; // stop further execution
    }

    // ✅ Strong password validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById('signup_otp_msg').innerText = 'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.';
        return;
    }

    const formData = new FormData(form);

    fetch('send_signup_otp.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('signup_otp_msg').innerText = data;
        document.getElementById('signup_otp_input').style.display = 'block';
        document.getElementById('verify_signup_otp').style.display = 'block';
    })
    .catch(error => {
        document.getElementById('signup_otp_msg').innerText = 'Error sending OTP';
        console.error(error);
    });
});


// ==================== Verify Signup OTP & Insert User ====================

document.getElementById('verify_signup_otp').addEventListener('click', function(){
    const form = document.getElementById('signup_otp_form');
    const formData = new FormData(form);

    fetch('signup_verify.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('signup_verify_msg').innerText = data;
        if(data.includes("Signup successful")){
            setTimeout(() => {
                window.location.href = "chatrix.php";
            }, 2000);
        }
    })
    .catch(error => {
        document.getElementById('signup_verify_msg').innerText = 'Error verifying OTP';
        console.error(error);
    });
});

document.getElementById('show_password_signup').onclick = () => {
  document.querySelector('input[name="password"]').type = document.getElementById('show_password_signup').checked ? 'text' : 'password';
};

// ==================== Chat Functions ====================

function showChatBox(friendshipId, friendName) {
    // Hide all chat boxes first
    const allChatBoxes = document.querySelectorAll('.chat_box');
    allChatBoxes.forEach(box => {
        box.style.display = 'none';
    });
    
    // Show the selected chat box
    const chatBox = document.getElementById('chat_box_' + friendshipId);
    if (chatBox) {
        chatBox.style.display = 'block';
        
        // Mobile mode: Position chat box over members section
        if (window.innerWidth <= 800) {
            // Position the chat box to cover the members section
            chatBox.style.position = 'fixed';
            chatBox.style.top = '10vh'; // Start below the nav
            chatBox.style.left = '1%';
            chatBox.style.width = '98%';
            chatBox.style.height = '88vh';
            chatBox.style.zIndex = '1000';
            chatBox.style.backgroundColor = '#252525';
            chatBox.style.borderRadius = '5px';
        } else {
            // Desktop mode: Reset styles
            chatBox.style.position = 'absolute';
            chatBox.style.top = 'auto';
            chatBox.style.left = 'auto';
            chatBox.style.width = '90%';
            chatBox.style.height = '80vh';
            chatBox.style.zIndex = 'auto';
        }
        
        // Load messages for this friendship
        loadMessages(friendshipId);
    }
}

function hideChatBox() {
    // Hide all chat boxes
    const allChatBoxes = document.querySelectorAll('.chat_box');
    allChatBoxes.forEach(box => {
        box.style.display = 'none';
    });
    
    // No need to show/hide members panel since chat overlays it
}

function sendMessage(friendshipId) {
    const messageInput = document.getElementById('input_' + friendshipId);
    const message = messageInput.value.trim();
    
    if (message === '') {
        return;
    }
    
    const formData = new FormData();
    formData.append('friendship_id', friendshipId);
    formData.append('message', message);
    formData.append('sender_uid', current_user_uid);
    
    fetch('send_message.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success') {
            messageInput.value = '';
            loadMessages(friendshipId);
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
    });
}

function loadMessages(friendshipId) {
    fetch('load_messages.php?friendship_id=' + friendshipId)
    .then(response => response.text())
    .then(data => {
        document.getElementById('messages_' + friendshipId).innerHTML = data;
        // Scroll to bottom
        const messagesContainer = document.getElementById('messages_' + friendshipId);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    })
    .catch(error => {
        console.error('Error loading messages:', error);
    });
}

// ==================== Search Functions ====================

document.querySelector('.search_a').addEventListener('click', function() {
    document.querySelector('.search_main').style.display = 'block';
    
    // No need to hide members panel since search overlays it
});

document.querySelector('.back1').addEventListener('click', function() {
    document.querySelector('.search_main').style.display = 'none';
    
    // No need to show members panel since it's always visible
});

document.getElementById('search_btn').addEventListener('click', function() {
    const uid = document.getElementById('search_box').value.trim();
    
    if (uid === '') {
        document.getElementById('search_result').innerHTML = 'Please enter a UID to search.';
        return;
    }
    
    const formData = new FormData();
    formData.append('uid', uid);
    
    fetch('search_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('search_result').innerHTML = data;
    })
    .catch(error => {
        document.getElementById('search_result').innerHTML = 'Error searching user.';
        console.error(error);
    });
});

function addFriend(uid) {
    const formData = new FormData();
    formData.append('friend_uid', uid);
    formData.append('user_uid', current_user_uid);
    
    fetch('add_friend.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        if (data.includes('success')) {
            location.reload(); // Refresh to show new friend
        }
    })
    .catch(error => {
        console.error('Error adding friend:', error);
    });
}

// ==================== Auto-refresh messages ====================
setInterval(function() {
    const visibleChatBox = document.querySelector('.chat_box[style*="display: block"]');
    if (visibleChatBox) {
        const friendshipId = visibleChatBox.id.replace('chat_box_', '');
        loadMessages(friendshipId);
    }
}, 3000); // Refresh every 3 seconds

// ==================== Handle Enter key in message input ====================
document.addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && e.target.classList.contains('input_msg')) {
        e.preventDefault();
        const friendshipId = e.target.id.replace('input_', '');
        sendMessage(friendshipId);
    }
});

// ==================== Handle window resize ====================
window.addEventListener('resize', function() {
    const chatBoxes = document.querySelectorAll('.chat_box');
    chatBoxes.forEach(box => {
        if (box.style.display === 'block') {
            if (window.innerWidth <= 800) {
                // Mobile mode: Position over members section
                box.style.position = 'fixed';
                box.style.top = '10vh';
                box.style.left = '1%';
                box.style.width = '98%';
                box.style.height = '88vh';
                box.style.zIndex = '1000';
                box.style.borderRadius = '5px';
            } else {
                // Desktop mode: Reset to normal positioning
                box.style.position = 'absolute';
                box.style.top = 'auto';
                box.style.left = 'auto';
                box.style.width = '90%';
                box.style.height = '80vh';
                box.style.zIndex = 'auto';
                box.style.borderRadius = 'auto';
            }
        }
    });
});