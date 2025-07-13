const userAddBtn = document.querySelector('.search_a');
const search_main = document.querySelector('.search_main');
const back = document.querySelector('.back1');

userAddBtn.addEventListener('click', () => {
    search_main.style.display = 'block';
});

back.addEventListener('click', () => {
    search_main.style.display = 'none';
});

document.getElementById('search_btn').addEventListener('click', () => {
    const uid = document.getElementById('search_box').value;

    fetch('search_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'uid=' + encodeURIComponent(uid)
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('search_result').innerHTML = data;
        })
        .catch(error => {
            document.getElementById('search_result').innerHTML = 'Error searching user';
            console.error(error);
        });
});


function addFriend(friend_uid) {
    const formData = new FormData();
    formData.append('friend_uid', friend_uid);

    fetch('add_friend.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // reload page to show updated friends list
        })
        .catch(error => {
            alert('Error adding friend.');
            console.error(error);
        });
}

let currentFriendshipId = null; // 🔥 Store current active chat

function showChatBox(friendship_id, friend_name) {
    // Hide welcome text
    document.getElementById('welcome_text').style.display = 'none';

    // Hide all chat boxes first
    document.querySelectorAll('.chat_box').forEach(box => {
        box.style.display = 'none';
    });

    // Show the selected friend’s chat box
    const chatBox = document.getElementById(`chat_box_${friendship_id}`);
    chatBox.style.display = 'block';

    const chatContainer = document.querySelector('.chat');

    if (window.innerWidth <= 800) {
        // Mobile mode: show as overlay and hide members
        document.querySelector('.members').style.display = 'none';
        chatContainer.classList.add('active');
    } else {
        // Desktop mode: keep members visible and remove overlay class
        document.querySelector('.members').style.display = 'grid';
        chatContainer.classList.remove('active');
        chatContainer.style.display = 'block';
    }

    currentFriendshipId = friendship_id;

    loadMessages(friendship_id);
}

    // function hideChatBox() {
    //     if (currentFriendshipId !== null) {
    //         document.getElementById(`chat_box_${currentFriendshipId}`).style.display = 'none';
    //         currentFriendshipId = null;
    //     }

    //     // Show welcome text again when no chat box is open
    //     document.getElementById('welcome_text').style.display = 'block';

    //     const chatContainer = document.querySelector('.chat');

    //     if (window.innerWidth <= 800) {
    //         chatContainer.classList.remove('active');
    //         document.querySelector('.members').style.display = 'grid';
    //     } else {
    //         chatContainer.classList.remove('active');
    //         chatContainer.style.display = 'block';
    //     }
    // }




// After messages are loaded, add click listeners
function loadMessages(friendship_id) {
    fetch(`get_message.php?friendship_id=${friendship_id}`)
        .then(response => response.json())
        .then(data => {
            let messagesDiv = document.getElementById(`messages_${friendship_id}`);
            messagesDiv.innerHTML = '';

            data.forEach(msg => {
                let alignClass = (msg.sender_uid == current_user_uid) ? 'my_message' : 'friend_message';
                let senderName = (msg.sender_uid == current_user_uid) ? 'You' : msg.sender_uid;

                let timeOnly = "";
                if (msg.timestamp) {
                    const dateObj = new Date(msg.timestamp);
                    timeOnly = dateObj.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                }
messagesDiv.innerHTML += `
  <div class="message-container ${alignClass}">
    <p class="message-text"><b>${senderName}:</b> ${msg.message_text}</p>
    <span class="message-time">${timeOnly}</span>
  </div>
`;

            });

            messagesDiv.scrollTop = messagesDiv.scrollHeight;

            // Add click listener to toggle time visibility
            document.querySelectorAll(`#messages_${friendship_id} .message-container`).forEach(msgElem => {
                msgElem.addEventListener('click', () => {
                    msgElem.classList.toggle('show-time');
                });
            });
        })
        .catch(error => console.error(error));
}





const sendSound = new Audio('tone.wav');

// Optional: Unlock audio on first user interaction
document.addEventListener('click', () => {
    sendSound.play().then(() => {
        sendSound.pause();
        sendSound.currentTime = 0;
    }).catch(() => { });
}, { once: true });

function sendMessage(friendship_id) {
    let input = document.getElementById(`input_${friendship_id}`);
    let msg = input.value.trim();
    if (msg === '') return;

    const formData = new FormData();
    formData.append('friendship_id', friendship_id);
    formData.append('message_text', msg);

    fetch('send_message.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            input.value = '';
            loadMessages(friendship_id);

            // ✅ Play sound
            sendSound.currentTime = 0;
            sendSound.play().catch(err => console.log("Play error:", err));

        })
        .catch(error => console.error(error));
}


// 🔥🔥🔥 Setup AJAX polling every 3 seconds for active chat

setInterval(() => {
    if (currentFriendshipId !== null) {
        loadMessages(currentFriendshipId);
    }
}, 3000); // 3000 ms = 3 seconds


// =============================Profile section==========================

const profile_div = document.querySelector('.profile');
const profile_view = document.querySelector('.profile_btn');
const profile_view2 = document.querySelector('.profile_btn2');
const back_2 = document.querySelector('.back2');

profile_view.addEventListener('click', () => {
    profile_div.style.display = 'block';
});

profile_view2.addEventListener('click', () => {
    profile_div.style.display = 'block';
});


back_2.addEventListener('click', () => {
    profile_div.style.display = 'none';
});


document.getElementById('update_profile_btn').addEventListener('click', function () {
    const newName = document.getElementById('username_input').value;
    const mobile = document.getElementById('mobile_input').value;
    const gender = document.getElementById('gender_input').value;
    const bio = document.getElementById('bio_input').value;
    const theme = document.querySelector('input[name="theme"]:checked').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_profile.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('update_status').innerText = this.responseText;
    }

    const params = 'new_name=' + encodeURIComponent(newName) +
        '&mobile=' + encodeURIComponent(mobile) +
        '&gender=' + encodeURIComponent(gender) +
        '&bio=' + encodeURIComponent(bio) +
        '&theme=' + encodeURIComponent(theme);

    xhr.send(params);
});

document.addEventListener('DOMContentLoaded', () => {
    const themeRadios = document.querySelectorAll('input[name="theme"]');

    // Apply saved theme from localStorage
    const savedTheme = localStorage.getItem('theme') || 'default';
    applyTheme(savedTheme);

    // Set the radio button as checked
    themeRadios.forEach(radio => {
        if (radio.value === savedTheme) {
            radio.checked = true;
        }
    });

    // Add event listeners to change theme on click and save in localStorage
    themeRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            const selectedTheme = radio.value;
            localStorage.setItem('theme', selectedTheme);
            applyTheme(selectedTheme);
        });
    });
});

function applyTheme(theme) {
    document.body.classList.remove('theme-default', 'theme-dark', 'theme-extra-dark');

    if (theme === 'default' || theme === 'dark' || theme === 'extra-dark') {
        document.body.classList.add('theme-' + theme);
    } else {
        document.body.classList.add('theme-default');
    }
}


function showCreateGroup() {
  document.getElementById('create_group_modal').style.display = 'block';
}

function hideCreateGroup() {
  document.getElementById('create_group_modal').style.display = 'none';
}

function createGroup() {
  var group_name = document.getElementById('group_name').value;
  var members = [];
  document.querySelectorAll('#member_list input[type=checkbox]:checked').forEach(function(checkbox) {
    members.push(checkbox.value);
  });

  var formData = new FormData();
  formData.append('group_name', group_name);
  members.forEach((id, index) => {
    formData.append('members[]', id); // send as array
  });

  fetch('create_group.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    alert(data);
    hideCreateGroup();
    location.reload(); // refresh to see updated groups
  });
}


function showGroupChatBox(group_id, group_name) {
  // Hide all chat boxes first (both friend and group)
  document.querySelectorAll('.chat_box').forEach(box => {
    box.style.display = 'none';
  });

  // Show the group chat box
  const box = document.getElementById('group_chat_box_' + group_id);
  if (box) {
    box.style.display = 'block';
    document.getElementById('welcome_text').style.display = 'none';

    // Mobile/desktop display logic same as friend chat
    const chatContainer = document.querySelector('.chat');

    if (window.innerWidth <= 800) {
      // Mobile mode: show chat overlay, hide members list
      document.querySelector('.members').style.display = 'none';
      chatContainer.classList.add('active');
    } else {
      // Desktop mode: show members and chat side by side
      document.querySelector('.members').style.display = 'grid';
      chatContainer.classList.remove('active');
      chatContainer.style.display = 'block';
    }

    loadGroupMessages(group_id);
  }
}



function loadGroupMessages(group_id) {
  fetch('get_group_messages.php?group_id=' + group_id)
    .then(response => response.json())
    .then(messages => {
      const msgDiv = document.getElementById('group_messages_' + group_id);
      msgDiv.innerHTML = "";

      messages.forEach(msg => {
        const msgEl = document.createElement('p');
        msgEl.innerHTML = "<strong>" + msg.name + ":</strong> " + msg.message;
        msgDiv.appendChild(msgEl);
      });

      msgDiv.scrollTop = msgDiv.scrollHeight;
    });
}



function sendGroupMessage(group_id) {
  const input = document.getElementById('group_input_' + group_id);
  const message = input.value.trim();

  if (message !== "") {
    fetch('send_group_message.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'group_id=' + encodeURIComponent(group_id) + '&message=' + encodeURIComponent(message)
    })
    .then(response => response.text())
    .then(data => {
      if (data === "success") {
        input.value = "";
        loadGroupMessages(group_id);
      } else {
        alert("Error sending message: " + data);
      }
    });
  }
}

function hideChatBox() {
  document.getElementById('welcome_text').style.display = 'block';

  // Hide all individual friend chat boxes
  const friendChatBoxes = document.querySelectorAll('[id^="chat_box_"]');
  friendChatBoxes.forEach(box => {
    box.style.display = 'none';
  });

  // Hide all group chat boxes
  const groupChatBoxes = document.querySelectorAll('[id^="group_chat_box_"]');
  groupChatBoxes.forEach(box => {
    box.style.display = 'none';
  });

  // Reset currentFriendshipId for friends chat
  currentFriendshipId = null;

  const chatContainer = document.querySelector('.chat');
  if (window.innerWidth <= 800) {
    chatContainer.classList.remove('active');
    document.querySelector('.members').style.display = 'grid';
  } else {
    chatContainer.classList.remove('active');
    chatContainer.style.display = 'block';
  }
}

setInterval(() => {
  document.querySelectorAll("[id^='group_chat_box_']").forEach(box => {
    if (box.style.display !== "none") {
      const group_id = box.id.split("_").pop();
      loadGroupMessages(group_id);
    }
  });
}, 3000);

messages.forEach(msg => {
  // Decide if message is from me or others
  const alignClass = (msg.sender_uid == current_user_uid) ? 'gp_my_message' : 'gp_friend_message';

  const msgEl = document.createElement('div');
  msgEl.classList.add('message-container', alignClass);

  // message text + time (optional)
  msgEl.innerHTML = `
    <p class="message-text"><b>${msg.name}:</b> ${msg.message}</p>
  `;

  msgDiv.appendChild(msgEl);
});
