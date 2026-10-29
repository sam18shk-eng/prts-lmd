<x-app-layout>
    <div class="py-8 bg-gray-950 min-h-screen text-gray-100 font-mono">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                <div>
                    <h2 class="text-2xl font-bold tracking-widest text-blue-400">P.R.T.S // FINANCIAL_SYSTEM</h2>
                    <p class="text-xs text-gray-400">OPERATOR: {{ strtoupper(Auth::user()->name) }}</p>
                </div>
                <span class="px-3 py-1 bg-blue-950 border border-blue-500/50 text-blue-400 text-xs rounded tracking-wider">
                    SYSTEM_ONLINE
                </span>
            </div>

            <div class="p-4 border-l-4 border-cyan-400 bg-gray-900 border border-gray-800 rounded-r">
                <p class="text-xs text-cyan-400 font-bold tracking-wider mb-1">PRIESTESS_MESSAGE_LOG:</p>
                <p class="text-base italic text-cyan-200">"{{ $randomQuote }}"</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-5 bg-gray-900 border border-gray-800 rounded shadow-lg">
                    <p class="text-xs text-gray-400 tracking-wider">TOTAL_LMD_SAVINGS (SALDO)</p>
                    <p class="text-3xl font-bold text-green-400 mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>
                <div class="p-5 bg-gray-900 border border-gray-800 rounded shadow-lg">
                    <p class="text-xs text-gray-400 tracking-wider">TOTAL_INCOME</p>
                    <p class="text-2xl font-bold text-blue-400 mt-2">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
                <div class="p-5 bg-gray-900 border border-gray-800 rounded shadow-lg">
                    <p class="text-xs text-gray-400 tracking-wider">TOTAL_EXPENSE</p>
                    <p class="text-2xl font-bold text-red-400 mt-2">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="p-6 bg-gray-900 border border-gray-800 rounded">
                <h3 class="text-lg font-bold text-gray-200 mb-4 tracking-wider">// RECORD_TRANSACTION</h3>
                
                <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">TYPE</label>
                        <select name="type" class="w-full bg-gray-950 border border-gray-700 rounded text-sm text-gray-100 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                            <option value="income">INCOME (+)</option>
                            <option value="expense">EXPENSE (-)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">AMOUNT (RP)</label>
                        <input type="number" name="amount" placeholder="0" class="w-full bg-gray-950 border border-gray-700 rounded text-sm text-gray-100 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">DESCRIPTION</label>
                        <input type="text" name="description" placeholder="Catatan transaksi..." class="w-full bg-gray-950 border border-gray-700 rounded text-sm text-gray-100 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">DATE</label>
                        <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" class="w-full bg-gray-950 border border-gray-700 rounded text-sm text-gray-100 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded transition-all tracking-wider">
                            + EXECUTE
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-6 bg-gray-900 border border-gray-800 rounded">
                <h3 class="text-lg font-bold text-gray-200 mb-4 tracking-wider">// TRANSACTION_HISTORY</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-400">
                        <thead class="bg-gray-950 text-gray-400 uppercase text-xs border-b border-gray-800">
                            <tr>
                                <th class="py-3 px-4">DATE</th>
                                <th class="py-3 px-4">TYPE</th>
                                <th class="py-3 px-4">DESCRIPTION</th>
                                <th class="py-3 px-4">AMOUNT</th>
                                <th class="py-3 px-4 text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse($transactions as $item)
                                <tr class="hover:bg-gray-800/50">
                                    <td class="py-3 px-4 whitespace-nowrap">{{ $item->transaction_date }}</td>
                                    <td class="py-3 px-4">
                                        @if($item->type === 'income')
                                            <span class="text-green-400 font-bold">[INCOME]</span>
                                        @else
                                            <span class="text-red-400 font-bold">[EXPENSE]</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-gray-200">{{ $item->description }}</td>
                                    <td class="py-3 px-4 font-bold {{ $item->type === 'income' ? 'text-green-400' : 'text-red-400' }}">
                                        Rp {{ number_format($item->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('transactions.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus log transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 text-xs tracking-wider">
                                                [DELETE]
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">NO_DATA_LOGGED_IN_PRTS</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>