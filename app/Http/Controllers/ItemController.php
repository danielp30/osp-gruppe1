namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformationStand;
use App\Models\Lecture;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Get the logged-in user
        $user = $request->user();

        // Query items belonging to the user
        $items = $user->is_admin ? 
            InformationStand::with('user')->get() : 
            InformationStand::with('user')->where('user_id', $user->id)->get();

        // You can do the same for lectures if needed

        return response()->json($items);
    }
}
