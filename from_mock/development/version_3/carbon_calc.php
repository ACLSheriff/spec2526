<?php








$result = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $op   = $_POST['op'];

    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Both inputs must be valid numbers.";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        switch ($op) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    $error = "You cannot divide by zero.";
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = "Invalid operator.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="calc-wrapper">
<div class="calc-container">
    <h2>PHP Calculator</h2>

    <form method="post">
        <input type="text" name="num1" placeholder="Enter first number" required>

        <select name="op">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>

        <input type="text" name="num2" placeholder="Enter second number" required>

        <button type="submit">Calculate</button>
    </form>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($result !== ""): ?>
        <div class="result">Result: <strong><?= htmlspecialchars($result) ?></strong></div>
    <?php endif; ?>

</div>
</div>
</body>
</html>