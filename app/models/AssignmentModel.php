<?php
require_once __DIR__ . '/Database.php';
function getTeacherAssignments($teacherId, $classId = null) {
    global $conn;
    
    $whereClass = $classId ? " AND class_id = $classId" : "";
    $sql = "SELECT * FROM assignments WHERE teacher_id = $teacherId $whereClass ORDER BY due_date DESC, created_at DESC";
    $result = $conn->query($sql);

    $assignments = [];
    if ($result) {
        while ($assignment = $result->fetch_assoc()) {
            if ($assignment['class_id']) {
                $classSql = "SELECT class_name, class_code FROM classes WHERE id = " . $assignment['class_id'];
                $classResult = $conn->query($classSql);
                if ($classResult && $class = $classResult->fetch_assoc()) {
                    $assignment['class_name'] = $class['class_name'];
                    $assignment['class_code'] = $class['class_code'];
                } else {
                    $assignment['class_name'] = null;
                    $assignment['class_code'] = null;
                }
            } else {
                $assignment['class_name'] = null;
                $assignment['class_code'] = null;
            }

            // Count submissions
            $subSql = "SELECT COUNT(*) as count FROM assignment_submissions WHERE assignment_id = " . $assignment['id'];
            $subResult = $conn->query($subSql);
            if ($subResult && $subRow = $subResult->fetch_assoc()) {
                $assignment['submission_count'] = $subRow['count'];
            } else {
                $assignment['submission_count'] = 0;
            }

            $assignments[] = $assignment;
        }
    }

    return $assignments;
}

function createAssignment($teacherId, $title, $instructions, $deadline, $requirements, $filePath, $maxPoints, $gradingCriteria, $visibility, $classId = null) {
    global $conn;

    $title = $conn->real_escape_string($title);
    $instructions = $conn->real_escape_string($instructions ?? '');
    $requirements = $conn->real_escape_string($requirements ?? '');
    $gradingCriteria = $conn->real_escape_string($gradingCriteria ?? '');
    $visibility = $conn->real_escape_string($visibility ?? 'visible');
    $filePath = $filePath ? $conn->real_escape_string(basename($filePath)) : null;

    $dueDate = !empty($deadline) ? "'" . $conn->real_escape_string($deadline) . "'" : "NULL";
    $classId = $classId ? (int)$classId : "NULL";
    $maxPoints = (int)$maxPoints;

    $sql = "INSERT INTO assignments 
            (teacher_id, class_id, title, description, due_date, max_marks, attachment, grading_criteria, visibility) 
            VALUES 
            ($teacherId, $classId, '$title', '$instructions', $dueDate, $maxPoints, " . 
            ($filePath ? "'$filePath'" : "NULL") . ", 
            '$gradingCriteria', '$visibility')";

    if ($conn->query($sql)) {
        return $conn->insert_id;
    }
    return false;
}

function updateAssignmentData($assignmentId, $data) {
    global $conn;

    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description']);
    $dueDate = !empty($data['due_date']) ? "'" . $conn->real_escape_string($data['due_date']) . "'" : "NULL";
    $maxMarks = intval($data['max_marks']);
    $visibility = $conn->real_escape_string($data['visibility']);
    $attachment = !empty($data['attachment']) ? "'" . $conn->real_escape_string($data['attachment']) . "'" : "NULL";

    $sql = "UPDATE assignments
            SET title='$title',
                description='$description',
                due_date=$dueDate,
                max_marks=$maxMarks,
                visibility='$visibility',
                attachment=$attachment,
                updated_at=NOW()
            WHERE id=$assignmentId";

    return $conn->query($sql);
}

function getAssignmentById($id) {
    global $conn;
    $id = intval($id);
    $result = $conn->query("SELECT * FROM assignments WHERE id = $id");
    return $result->fetch_assoc();
}


?>
