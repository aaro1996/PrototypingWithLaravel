<template>
	<table class="gameboard">
		<tr v-for="row in rows">
			<td v-for="cell in row">
				<div :class="'square_tile x_' + cell.x + ' y_' + cell.y">
					<div>
						<p> x: {{cell.x}} y: {{cell.y}} </p>
					</div>
				</div>
			</td>
		</tr>
	</table>
</template>

<script>
export default {
	data: function() {
		return {

		}
	},
	props: ['rows'],
	methods: {

	},
}
</script>
