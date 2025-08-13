<?php
// Variables passed from controller:
// $bus (bus info), $seats (array of seat arrays with 'seat_number'), $bookedSeats (array of booked seat numbers), $error, $success
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Select Your Seat - <?= htmlspecialchars($bus['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    .seat {
      width: 36px;
      height: 36px;
      border-radius: 6px;
      cursor: pointer;
      user-select: none;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
    }
    .seat.available {
      background-color: #f3f4f6; /* gray-100 */
      border: 2px solid #9ca3af; /* gray-400 */
      color: #374151; /* gray-700 */
    }
    .seat.booked {
      background-color: #e5e7eb; /* gray-200 */
      border: 2px solid #d1d5db; /* gray-300 */
      color: #9ca3af; /* gray-400 */
      cursor: not-allowed;
    }
    .seat.selected {
      background-color: #059669 !important; /* Tailwind green-600 */
      border: 3px solid #065f46 !important; /* Tailwind green-800 */
      color: white !important;
      box-shadow: 0 0 8px #10b981;
    }
    .seat:hover.available:not(.selected) {
      background-color: #d1fae5; /* green-100 */
    }
  </style>
</head>
<body class="bg-white font-sans">
  <div class="max-w-md mx-auto mt-6 p-4">
    <h1 class="text-xl font-semibold mb-4 text-center">Select Your Seat</h1>

    <div class="mb-4 text-center">
      <p class="text-lg font-bold"><?= htmlspecialchars($bus['name'] ?? 'Bus') ?> - Route: <?= htmlspecialchars($bus['route'] ?? 'N/A') ?></p>
      <p class="text-gray-600">Base Fare: ৳4000.00</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" id="seatForm" class="space-y-6" novalidate>
      <div class="grid grid-cols-4 gap-4 justify-center mb-2">
        <?php
        // Layout logic: 4 seats per row with an aisle after 2 seats
        $seatsPerRow = 4;
        $aisleAfter = 2;
        $totalSeats = count($seats);

        for ($i = 0; $i < $totalSeats; $i++) {
            $seatNumber = $seats[$i]['seat_number'] ?? ($i + 1);
            $isBooked = in_array($seatNumber, $bookedSeats);
            $seatClass = $isBooked ? 'booked' : 'available';

            // tabindex=0 only for available seats for accessibility
            $tabIndex = $isBooked ? '' : 'tabindex="0"';

            echo '<div class="seat ' . $seatClass . '" data-seat="' . $seatNumber . '" ' . $tabIndex . '>';
            echo $seatNumber;
            echo '</div>';

            // Add aisle gap after $aisleAfter seats, except at row end
            if (($i + 1) % $aisleAfter === 0 && ($i + 1) % $seatsPerRow !== 0) {
                echo '<div></div>';
            }
        }
        ?>
      </div>

      <input type="hidden" name="seat_number" id="seatInput" value="" />

      <div class="flex justify-between items-center border-t pt-4">
        <div>
          <p class="font-semibold">Selected Seat: <span id="selectedSeats">None</span></p>
          <p class="text-gray-600">Base Fare: ৳4000.00</p>
        </div>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
          DONE
        </button>
      </div>
    </form>
  </div>

  <script>
    (function(){
      const seats = document.querySelectorAll('.seat.available');
      const selectedSeatsSpan = document.getElementById('selectedSeats');
      const seatInput = document.getElementById('seatInput');
      let selectedSeat = null; // only one seat allowed

      seats.forEach(seat => {
        seat.addEventListener('click', () => {
          const seatNumber = seat.getAttribute('data-seat');
          console.log("Clicked seat:", seatNumber);

          if (selectedSeat === seatNumber) {
            seat.classList.remove('selected');
            selectedSeat = null;
            console.log("Deselected seat:", seatNumber);
          } else {
            if (selectedSeat !== null) {
              const prevSelected = document.querySelector(`.seat.selected[data-seat="${selectedSeat}"]`);
              if (prevSelected) prevSelected.classList.remove('selected');
            }
            seat.classList.add('selected');
            selectedSeat = seatNumber;
            console.log("Selected seat:", seatNumber);
          }

          updateSelectedSeat();
        });

        seat.addEventListener('keydown', e => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            seat.click();
          }
        });
      });

      function updateSelectedSeat() {
        if (selectedSeat === null) {
          selectedSeatsSpan.textContent = 'None';
          seatInput.value = '';
        } else {
          selectedSeatsSpan.textContent = selectedSeat;
          seatInput.value = selectedSeat;
        }
        console.log("Current selectedSeat:", selectedSeat);
      }
    })();
  </script>
</body>
</html>
