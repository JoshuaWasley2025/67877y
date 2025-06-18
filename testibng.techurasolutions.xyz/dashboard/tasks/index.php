<?php
require_once __DIR__ . '/db.php';



// Initialize variables
$error = '';
$success = '';

// Handle Add New Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $item = trim($_POST['item'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? 'Pending';
    $due_date = $_POST['due_date'] ?? null;

    if (!$item) {
        $error = "Task name is required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO mindful_tasks (item, description, status, due_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $item, $description, $status, $due_date);
        if ($stmt->execute()) {
            $success = "Task added successfully.";
        } else {
            $error = "Error adding task: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle Delete Task
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM mindful_tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $success = "Task deleted.";
    } else {
        $error = "Error deleting task: " . $stmt->error;
    }
    $stmt->close();
    // Redirect to avoid resubmission
    header("Location: mindful_tasks.php");
    exit;
}

// Handle Update Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = intval($_POST['id'] ?? 0);
    $item = trim($_POST['item'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? 'Pending';
    $due_date = $_POST['due_date'] ?? null;

    if (!$item) {
        $error = "Task name is required.";
    } else {
        $stmt = $conn->prepare("UPDATE mindful_tasks SET item = ?, description = ?, status = ?, due_date = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $item, $description, $status, $due_date, $id);
        if ($stmt->execute()) {
            $success = "Task updated successfully.";
        } else {
            $error = "Error updating task: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch all tasks
$sql = "SELECT * FROM mindful_tasks ORDER BY due_date ASC";
$result = $conn->query($sql);

// For editing task (if ?edit=ID)
$edit_task = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $stmt = $conn->prepare("SELECT * FROM mindful_tasks WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $edit_task = $res->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <title>Mindful Tasks | JournalJoy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

<header class="bg-white shadow-md py-4 mb-6">
  <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-blue-600">JournalJoy - Mindful Tasks</h1>
  </div>
</header>

<main class="flex-grow max-w-7xl mx-auto px-6 pb-12">

  <?php if ($error): ?>
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  
  <?php if ($success): ?>
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <!-- Add or Edit Form -->
  <div class="bg-white shadow rounded p-6 mb-8 max-w-xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">
      <?php echo $edit_task ? "Edit Task" : "Add New Task"; ?>
    </h2>
    <form method="POST" class="space-y-4">
      <?php if ($edit_task): ?>
        <input type="hidden" name="id" value="<?php echo (int)$edit_task['id']; ?>" />
        <input type="hidden" name="action" value="update" />
      <?php else: ?>
        <input type="hidden" name="action" value="add" />
      <?php endif; ?>
      
      <div>
        <label for="item" class="block font-medium mb-1">Task Name <span class="text-red-600">*</span></label>
        <input
          type="text" id="item" name="item" required
          value="<?php echo htmlspecialchars($edit_task['item'] ?? ''); ?>"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="What do you want to focus on?"
        />
      </div>
      
      <div>
        <label for="description" class="block font-medium mb-1">Description</label>
        <textarea
          id="description" name="description" rows="3"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Add some details (optional)"
        ><?php echo htmlspecialchars($edit_task['description'] ?? ''); ?></textarea>
      </div>
      
      <div>
        <label for="status" class="block font-medium mb-1">Status</label>
        <select
          id="status" name="status"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <?php 
          $statuses = ['Pending', 'In Progress', 'Completed'];
          $current_status = $edit_task['status'] ?? 'Pending';
          foreach ($statuses as $s) {
              $selected = ($current_status === $s) ? 'selected' : '';
              echo "<option value=\"$s\" $selected>$s</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <label for="due_date" class="block font-medium mb-1">Due Date</label>
        <input
          type="date" id="due_date" name="due_date"
          value="<?php echo htmlspecialchars($edit_task['due_date'] ?? ''); ?>"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <button
        type="submit"
        class="w-full py-3 mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow"
      >
        <?php echo $edit_task ? "Update Task" : "Add Task"; ?>
      </button>
      <?php if ($edit_task): ?>
        <a href="mindful_tasks.php" class="block mt-2 text-center text-gray-600 hover:text-blue-600">Cancel Edit</a>
      <?php endif; ?>
    </form>
  </div>

  <!-- Tasks Table -->
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow overflow-hidden">
      <thead class="bg-blue-600 text-white">
        <tr>
          <th class="py-3 px-6 text-left">Task</th>
          <th class="py-3 px-6 text-left">Description</th>
          <th class="py-3 px-6 text-left">Status</th>
          <th class="py-3 px-6 text-left">Due Date</th>
          <th class="py-3 px-6 text-left">Created At</th>
          <th class="py-3 px-6 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b hover:bg-gray-100">
              <td class="py-4 px-6 font-semibold"><?php echo htmlspecialchars($row['item']); ?></td>
              <td class="py-4 px-6"><?php echo htmlspecialchars($row['description']); ?></td>
              <td class="py-4 px-6">
                <?php 
                  $status = $row['status'];
                  $color = 'text-gray-600';
                  if ($status === 'Completed') $color = 'text-green-600 font-bold';
                  elseif ($status === 'In Progress') $color = 'text-yellow-600 font-semibold';
                  elseif ($status === 'Pending') $color = 'text-red-600 font-semibold';
                  echo "<span class='$color'>$status</span>";
                ?>
              </td>
              <td class="py-4 px-6"><?php echo $row['due_date'] ? date('M d, Y', strtotime($row['due_date'])) : '-'; ?></td>
              <td class="py-4 px-6 text-sm text-gray-500"><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></td>
              <td class="py-4 px-6 space-x-2">
                <a href="?edit=<?php echo (int)$row['id']; ?>" 
                   class="text-blue-600 hover:underline font-semibold">Edit</a>
                <a href="?delete=<?php echo (int)$row['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this task?');"
                   class="text-red-600 hover:underline font-semibold">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center py-6 text-gray-500">No tasks found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  
</main>

<footer class="bg-white shadow-inner py-6 mt-auto text-center text-gray-600 text-sm">
  &copy; <?php echo date('Y'); ?> JournalJoy. All rights reserved.
</footer>

</body>
</html>

<?php
$conn->close();
?>
