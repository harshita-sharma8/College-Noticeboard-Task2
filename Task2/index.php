<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Notice Board - Dynamic Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <!-- Header with Notification Bell -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b">
            <h1 class="text-2xl font-bold text-gray-800">🎓 Digital Notice Board</h1>
            
            <!-- Notification Badge -->
            <div class="relative cursor-pointer" onclick="toggleNotifications()">
                <span class="text-2xl">🔔</span>
                <span id="notif-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full hidden">0</span>
                
                <!-- Notification Dropdown -->
                <div id="notif-dropdown" class="hidden absolute right-0 mt-2 w-72 bg-white border rounded-lg shadow-lg z-10 p-3">
                    <h3 class="font-semibold text-sm border-b pb-2 mb-2">Recent Announcements</h3>
                    <div id="notif-list" class="text-xs text-gray-600 space-y-2"></div>
                </div>
            </div>
        </div>

        <!-- 5 Category Filter Tabs -->
        <div class="flex flex-wrap gap-2 mb-6" id="category-tabs">
            <button onclick="loadNotices('All')" class="tab-btn bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">All</button>
            <button onclick="loadNotices('Events')" class="tab-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">Events</button>
            <button onclick="loadNotices('Holidays')" class="tab-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">Holidays</button>
            <button onclick="loadNotices('Exams')" class="tab-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">Exams</button>
            <button onclick="loadNotices('Internships')" class="tab-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">Internships</button>
            <button onclick="loadNotices('Placements')" class="tab-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">Placements</button>
        </div>

        <!-- Dynamic Notice Cards Display -->
        <div id="notice-container" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
    </div>

    <script>
        async function loadNotices(category = 'All') {
            const res = await fetch(`api/get_notices.php?category=${category}`);
            const data = await res.json();

            // Update Notification Count
            const badge = document.getElementById('notif-badge');
            if(data.unread_notifications > 0) {
                badge.innerText = data.unread_notifications;
                badge.classList.remove('hidden');
            }

            // Populate Notifications Dropdown
            const notifList = document.getElementById('notif-list');
            notifList.innerHTML = data.notifications.map(n => 
                `<div class="p-2 bg-gray-50 rounded border-l-2 border-blue-500">
                    <strong class="block">${n.title}</strong>
                    <span class="text-gray-400">${n.category} • ${n.created_at}</span>
                 </div>`
            ).join('');

            // Render Notices
            const container = document.getElementById('notice-container');
            if(data.notices.length === 0) {
                container.innerHTML = `<p class="col-span-2 text-center text-gray-500 py-6">No notices available in this category.</p>`;
                return;
            }

            container.innerHTML = data.notices.map(n => `
                <div class="border rounded-lg p-4 bg-white shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs bg-blue-100 text-blue-800 font-semibold px-2.5 py-0.5 rounded">${n.category}</span>
                        <span class="text-xs text-gray-400">${n.created_at}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">${n.title}</h3>
                    <p class="text-gray-600 text-sm">${n.content}</p>
                </div>
            `).join('');
        }

        function toggleNotifications() {
            document.getElementById('notif-dropdown').classList.toggle('hidden');
        }

        // Initial Load
        loadNotices('All');
    </script>
</body>
</html>